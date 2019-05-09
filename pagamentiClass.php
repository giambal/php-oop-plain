<?php

  class Pagamento  {

    public $id;
    public $status;
    public $price;
    public $prenotazione_id;
    public $pagante_id;

    function __construct($id , $status , $price , $prenotazione_id , $pagante_id ) {

      $this->id=$id;
      $this->status=$status;
      $this->price=$price;
      $this->prenotazione_id=$prenotazione_id;
      $this->pagante_id=$pagante_id;
    }

    function printVal(){

      echo "-" . $this->status . "<br>" .
          "id-" .  $this->id . " : " . $this->price . "<br>" . "<br>";
    }
  }

  $servername = "localhost";
  $username = "root";
  $password = "geforce2";
  $dbname = "prova";
  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_errno) {
    echo $conn->connect_error;
    return;
  }

  $sql1="
        SELECT *
        FROM pagamenti
        WHERE status LIKE 'accepted'
      ";

  $sql2="
        SELECT *
        FROM pagamenti
        WHERE status LIKE 'pending'
      ";

  $sql3="
        SELECT *
        FROM pagamenti
        WHERE status LIKE 'rejected'
      ";



    $result1 = $conn->query($sql1);
    $result2 = $conn->query($sql2);
    $result3 = $conn->query($sql3);


    $accepted=[];
    $pending=[];
    $rejected=[];

    if ($result1->num_rows > 0) {
      //output data of each row
      while($row1 = $result1->fetch_assoc()) {
        $accepted[]= new Pagamento($row1["id"],
                                  $row1["status"],
                                  $row1["price"],
                                  $row1["prenotazione_id"],
                                  $row1["pagante_id"]);
      }
    }

    if ($result2->num_rows > 0) {
      //output data of each row
      while($row2 = $result2->fetch_assoc()) {
        $pending[]= new Pagamento($row2["id"],
                                  $row2["status"],
                                  $row2["price"],
                                  $row2["prenotazione_id"],
                                  $row2["pagante_id"]);
      }
    }

    if ($result3->num_rows > 0) {
      //output data of each row
      while($row3 = $result3->fetch_assoc()) {
        $rejected[]= new Pagamento($row3["id"],
                                  $row3["status"],
                                  $row3["price"],
                                  $row3["prenotazione_id"],
                                  $row3["pagante_id"]);
      }
    }

    $conn->close();

    foreach ($accepted as $accPag) {
      $accPag->printVal();

    }

    foreach ($pending as $penPag) {
      $penPag->printVal();

    }

    foreach ($rejected as $rejPag) {
      $rejPag->printVal();

    }

 ?>
