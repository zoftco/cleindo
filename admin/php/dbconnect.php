<?php
	class dbConnect {
		public $conexion;

		public function connect($data) {
			$tryconnect = mysqli_connect($data['host'],$data['user'],$data['pass'],$data['db']);
            mysqli_set_charset($tryconnect,"utf8");
			if(!$tryconnect) {
				$respuesta = array(
					'success' => false,
					'message' => mysqli_error($tryconnect));

				die(json_encode($respuesta));
			}

			$this->conexion = $tryconnect;
		}

		public function checkifExists($table,$conditions) {
			$cond_string = $this->stringifyCond($conditions);

			$query = mysqli_query($this->conexion,'SELECT * FROM '.$table.' WHERE '.$cond_string);
			if(!$query) {
				$respuesta = array(
					'success' => false,
					'message' => mysqli_error($this->conexion));

				die(json_encode($respuesta));
			}

			if(mysqli_num_rows($query) == 0) {
				return false;
			}

			return mysqli_fetch_assoc($query);
		}

		public function deleteData($options) {
			$table = $options['table'];
			$conditions = '';
			if(array_key_exists('conditions', $options)) {
				$conditions = $this->stringifyCond($options['conditions']);
			}

			$cond_part = (strlen($conditions) > 0 ? 'WHERE '.$conditions : '');

			$querystr = 'DELETE FROM '.$table.' '.$cond_part;
			$query = mysqli_query($this->conexion, $querystr);
			if(!$query) {
				$respuesta = array(
					'success' => false,
					'message' => mysqli_error($this->conexion),
					'query' => $querystr);

				die(json_encode($respuesta));
			}

			return true;

		}

		public function getTabledata($options) {
			$table = $options['table'];
			$columns = $options['columns'];
			$order = '';
			$conditions = '';
			if(is_array($columns)) {
				$columsarray = array();
				foreach ($columns as $key => $value) {
					$columsarray[] = $key.' AS '.$value;
				};

				$columns = implode(', ', $columsarray);
			}

			if(array_key_exists('order', $options)) {
				$orderarray = array();
				foreach ($options['order'] as $key => $value) {
					$orderarray[] = $key.' '.$value;
				}

				$order = implode(', ', $orderarray);
			}

			if(array_key_exists('conditions', $options)) {
				$conditions = $this->stringifyCond($options['conditions']);
			}

			$cond_part = (strlen($conditions) > 0 ? 'WHERE '.$conditions : '');
			$order_part = (strlen($order) > 0 ? 'ORDER BY '.$order : '');

			$querystr = 'SELECT '.$columns.' FROM '.$table.' '.$cond_part.' '.$order_part;
			//print_r($querystr);die;
			$query = mysqli_query($this->conexion, $querystr);
			if(!$query) {
				$respuesta = array(
					'success' => false,
					'message' => mysqli_error($this->conexion),
					'query' => $querystr);

				die(json_encode($respuesta));
			}

			$count = mysqli_num_rows($query);
			if($count == 0) {
				return false;
			}

			$data = array();
			while($row = mysqli_fetch_assoc($query)) {
				$data[] = $row;
			}

			return $data;

		}

		public function getTableDataQuery($querystr) {
			$query = mysqli_query($this->conexion, $querystr);
			if(!$query) {
				$respuesta = array(
					'success' => false,
					'message' => mysqli_error($this->conexion),
					'query' => $querystr);

				die(json_encode($respuesta));
			}

			$count = mysqli_num_rows($query);
			if($count == 0) {
				return false;
			}

			$data = array();
			while($row = mysqli_fetch_assoc($query)) {
				$data[] = $row;
			}
			return $data;
		}

		public function insertData($options) {
			$table = $options['table'];
			$columns = $options['columns'];
			$columnsnames = array();
			$columnsvalues = array();

			foreach($columns as $key => $value) {
				$columnsnames[] = $key;
				$columnsvalues[] = '"'.$value.'"';
			};

			$querystr = 'INSERT INTO '.$table.'('.implode(',',$columnsnames).') VALUES('.implode(',',$columnsvalues).')';
			$query = mysqli_query($this->conexion,$querystr);
			if(!$query) {
				$respuesta = array(
					'success' => false,
					'message' => mysqli_error($this->conexion),
					'query' => $querystr);

				die(json_encode($respuesta));
			}

			$newid = mysqli_insert_id($this->conexion);

			$newdata = $columns;
			$newdata['admin_id'] = $newid;
			return array_map('utf8_encode',$newdata);
		}

		public function updateData($options) {
			$table = $options['table'];
			$columns = $options['columns'];
			$conditions = '';

			if(array_key_exists('conditions', $options)) {
				$conditions = $this->stringifyCond($options['conditions']);
			}

			$columns_array = array();
			foreach ($columns as $key => $value) {
				$columns_array[] = $key.'="'.$value.'"';
			};

			$columnsstr = implode(', ',$columns_array);
			$cond_part = (strlen($conditions) > 0 ? 'WHERE '.$conditions : '');

			$querystr = 'UPDATE '.$table.' SET '.$columnsstr.' '.$cond_part;
			$query = mysqli_query($this->conexion,$querystr);

			if(!$query) {
				$respuesta = array(
					'success' => false,
					'message' => mysqli_error($this->conexion),
					'query' => $querystr,
					'columns' => $columnsstr);

				die(json_encode($respuesta));
			}

			return true;
		}

		public function stringifyCond($conditions) {
			$output = array();
			foreach ($conditions as $key => $value) {
				$cond = $key.'="'.$value.'"';
				$output[] = $cond;
			}

			return implode(' AND ', $output);
		}

		public function disconnect() {
			mysqli_close($this->conexion);
		}
	}
?>