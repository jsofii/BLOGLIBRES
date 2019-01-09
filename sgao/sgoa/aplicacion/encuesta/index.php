
<html>
    <head>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>  
    </head>
  
<body >

<?php
    
   
    
    include 'Poll.php';
    $poll = new Poll;

    
    $pollData = $poll->getPolls();

?>


<div class="container">
        <div class="image-container">
            <img src="epn.png" alt="EPN" />
        </div>
    <?php echo !empty($statusMsg)?'<p class="stmsg">'.$statusMsg.'</p>':''; ?>
    <form action="" method="post" name="pollFrm">
    <h3><?php echo $pollData['poll']['subject']; ?></h3>
    <ul>
        <?php foreach($pollData['options'] as $opt){
            echo '<li><input type="radio" name="voteOpt" value="'.$opt['id'].'" >'.$opt['name'].'</li>';
        } ?>
    </ul>
    <input type="hidden" name="pollID" value="<?php echo $pollData['poll']['id']; ?>">
    
    <input type="submit" name="voteSubmit" class="button center" value="Votar">
    

    <!--<a href="results.php?pollID=<?php echo $pollData['poll']['id']; ?>">Resultados</a>-->
   



    </form>
</div>

<?php
    //if vote is submitted
if(isset($_POST['voteSubmit'])){
    $voteData = array(
        'poll_id' => $_POST['pollID'],
        'poll_option_id' => $_POST['voteOpt']
       
    );
    //insertar
    //echo 'llegue aqui?';
    $voteSubmit = $poll->vote($voteData);
    if($voteSubmit){
 
        echo '<script>alert("Voto registrado!")</script> ';
      
        echo "<script>location.href='../../index.php'</script>";

       
    }else{
        echo '<script>alert("Voto registrado!")</script> ';
      

        echo "<script>location.href='../../index.php'</script>";
       
    }
  }
?>


        

     </body>   
</html>



