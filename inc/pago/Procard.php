<?php
class ProcardConfig
{
    public $code = "4703047";
    public $user = "PRUEBARJ0";
    public $pass = "adcb7f9e9091da058d91533988e12f2e03195274";
	
    protected $db;
	
	/**
	 * Setea el atributo PDO con la instancia enviada por parámetro
	 * @param object PDO instance
	 */
    public function __construct(PDO $pdo) {
        $this->db = $pdo;
    }

	/**
	 * Registra una nueva transacción en la tabla de transacciones y devuelve un número de transacción (El ID del registro).
	 * @param string amount: el importe de la transacción
	 * @return int el número de trasacción
	 */
    public function newTransaction($amount) {
        $this->db->prepare("INSERT INTO transactions (status, amount) VALUES('new', ?)")->execute(array($amount));
        return $this->db->lastInsertId();
    }
	
	/**
	 * Retorna todos los campos relacionados a la transacción, dado un UUID
	 * @param string UUID de la transacción
	 * @return array
	 */
    public function getTransaction($uuid) {
        $cursor = $this->db->prepare("SELECT * FROM transactions WHERE uuid = ? LIMIT 1");
        $cursor->execute(array($uuid));
        $all = $cursor->fetchAll();
        if (empty($all)) {
            return false;
        }
        return $all[0];
    }
	
	/**
	 * Actualiza el registro de una transacción, según los campos enviados por parámetro.
	 * @param array key=>value de los campos retornados desde el gateway
	 * @param array key=>value para el where
	 */
    public function updateTransaction(Array $data, Array $filter) {
        $set = array();
        foreach (array_keys($data) as $key) {
            $set[] = "$key = :$key";
        }
        $where = array();
        foreach (array_keys($filter) as $key) {
            $where[] = "$key = :$key";
        }

        $this->db->prepare("UPDATE transactions SET  " . implode(",", $set) 
            . " where " . implode(" and ", $where) )
            ->execute(array_merge($data, $filter));
    }
}

class Procard
{
    #Ruta al certificado
    const ECOM_CERT_PATH = "testing.procard.com.py.cer";
    #Url del gateway de pagos
    const ECOM_ROOT_CTX = "https://testing.procard.com.py/v4";

    protected $config;


	/**
	 * Genera la firma de la mensajería
	 * @param string URL a invocar
	 * @param array la data a utilizar para generar la firma
	 * return string sha1 de los datos
	 */
    protected function getSignature($url, Array $data) {
        $raw[] = ['__url', $url];
        foreach ($data as $key => $value) {
            if ($key != 'signature') {
                $raw[] = [$key, $value];
            }
        }
		
        usort($raw, function($a, $b) {
            return $a[0] > $b[0];
        });

        return sha1(json_encode($raw));
    }

	/**
	 * Invoca a la URL, según parámetro
	 * @param string url a invocar
	 * @param array parámetros a enviar
	 * @return string respuesta en formato JSON
	 */
    protected function wget($url, $parms) {
    $url   = self::ECOM_ROOT_CTX. "/" . $url;
        $parms = array_merge(array(
            "user"=> $this->config->user,
            "date" => date('c'),
            "cod" => $this->config->code,
        ), $parms);

        $parms["pass"] = sha1($parms['date'] . ':' . $this->config->pass);
        $parms['signature'] = $this->getSignature($url, $parms);
		
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_CAINFO, self::ECOM_CERT_PATH);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $parms);
        $resp = curl_exec($ch);
        echo $resp;
        $json = json_decode($resp);

        if (!$json) {
            throw new \RuntimeException($resp);
        }
		
		if($json->success === false) throw new \RuntimeException($json->message);

        curl_close($ch);
        return $json;
    }

	/**
	 * Genera una nueva transacción
	 * @param string importe
	 * @param bool raw retorna respuesta en vez de realizar el redireccionamiento
	 */
    public function newTransaction($amount, $raw) { 
        $id = $this->config->newTransaction($amount);

        $params = array(
            "imp"=>$amount, 
            "nrotx"=>$id,
        );
        
		$response = $this->wget('generar_transaccion.php', $params);
		
        $this->config->updateTransaction(array('uuid' => $response->uuid), array('id' => $id, 'status' => 'new'));
        
		if ($raw) return $response;
        header("Location: " . self::ECOM_ROOT_CTX . "/pagar.php?uuid=" . $response->uuid);
        exit;
    }

	/**
	 * Retorna el resultado de la transaccion en formato JSON
	 * @param string $uuid El UUID de la transaccion
	 * @return string JSON con los campos de resultado
	 */

    public function checkResult($uuid = '') {
    	$uuid = empty($_REQUEST['uuid']) ? $uuid : $_REQUEST['uuid'];
		
        if (empty($uuid)) {
        	return false;	
        }
		
        $data = $this->config->getTransaction($uuid);
        if (empty($data)) {
            return false;
        }

        $result = self::wget('confirmar_transaccion.php', array('uuid' => $data['uuid']));

        $this->config->updateTransaction((Array)$result, array('id' => (string)$data['id']));

        return $result;
    }
	
	/**
	 * Anula una transacción
	 * @param string UUID de la transacción
	 * @return string JSON de la respuesta
	 * 
	 */
	public function transactionRollback($uuid) {
		$data = $this->config->getTransaction($uuid);
		
		if(empty($data)) {
			return false;
		}
		
		$result = self::wget('anular_transaccion.php', array('uuid' => $data['uuid'], 'nrotx' => (string)$data['id']));
		
		$this->config->updateTransaction((Array)$result, array('id' => $data['id']));
		
		return $result;
	}
	
	/**
	 * Constructor de la clase
	 * @param object ProcardConfig
	 */
	
    public function __construct(ProcardConfig $config) {
        $this->config = $config;
    }
}

# Nueva instancia PDO
$db = new PDO('mysql:host=localhost;dbname=procard', 
			  'root', 
			  '', 
			  array(
			  		PDO::ATTR_EMULATE_PREPARES => false, 
					PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
					)
			);

# Crea la tabla si no existe
$db->exec("
CREATE TABLE IF NOT EXISTS transactions(
    id integer primary key auto_increment,
    status varchar(20),
    amount decimal(15,2),
    uuid varchar(36),
    ip integer,
    created datetime default current_timestamp,
	success boolean,
	AuthorizationExecuted char(1),
	TimedOut char(1),
	MaxAttempts char(1),
	CardNumber char(4),
	CodRefAut int, 
	CodRespAut char(2),
	DescRespAut varchar(100),
	CodAut char(10),
	FechaAut char(20),
	CantCuotas tinyInt,
	TarClase varchar(50),
	ImpNeto decimal(15,2),
	ReversalExecuted char(1),
	ReversalCodRespAut char(2),
	ReversalDescRespAut varchar(100),
	ReversalCodAut char(10),
    unique (uuid)
)");

$procard = new Procard(new ProcardConfig($db));