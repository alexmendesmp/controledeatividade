<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Controle de Tarefas</title>
        <script src='assets/js/jquery-3.2.1.min.js'></script>
        <link rel='stylesheet' href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    </head>
    <body>

        <div class="jumbotron">
          <div class="container">              

            <div class="panel panel-default">
              <div class="panel-heading">Lista de Atividades</div>
              <div class="panel-body">
                  
                  <!--Status Message (alert)-->
                  <p><div id='statusMessage' class='alert alert-success' role='alert' style='display: none'></div></p>
                  <!--Status Message (alert)-->

                  <table class='table' id='activityList'></table>
                  
                <!--
                  <table class='table' id='activityList'>
                      <th>#</th>
                      <th>Nome</th>
                      <th>Descrição</th>
                      <th>Data de início</th>
                      <th>Data de finalização</th>
                      <th>Status</th>
                      <th>Situação</th>
                      <th>Ações</th>
                      
                      <div id='tdActivitylist'></div>
                      
                      <?php foreach ( $this->data as $activity ) : ?>
                      <tr>
                          <td><?php echo $activity['id'] ?></td>
                          <td><?php echo $activity['name'] ?></td>
                          <td><?php echo $activity['description'] ?></td>
                          <td><?php echo $activity['start_date'] ?></td>
                          <td><?php echo $activity['end_date'] ?></td>
                          <td><?php echo $activity['status']['description'] ?></td>
                          <td><?php echo App\Models\Activity::$STATE[$activity['state']] ?></td>
                          <td>
                      
                            <div class="btn-group" role="group" aria-label="...">
                                <?php $id = $activity['id'] ?>
                                <a href="#" class='actionButton' data-type='update' data-id='<?php echo $id ?>'><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                                <a href="#" class='actionButton' data-type='delete' data-id='<?php echo $id ?>'><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                            </div>                              
                          </td>
                      </tr>
                      <?php endforeach; ?>
                      -->
                  </table>
                  
              </div>
            </div>              
              

            
          </div>
        </div>        
        <!--scripts-->
        <script src='assets/js/MessagesHandler.js'></script>
        <script src='assets/js/ActivityService.js'></script>
        <script src='assets/js/main.js'></script>
        <script src='vendor/twbs/bootstrap/dist/js/bootstrap.min.js'></script>
    </body>
</html>

