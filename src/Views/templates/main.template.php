<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Controle de Tarefas</title>
        <script src='assets/js/jquery-3.2.1.min.js'></script>
        <link rel='stylesheet' href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
        <link rel='stylesheet' href="assets/js/uikit/css/uikit.min.css">
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
              </div>
            </div>              
            
          </div>
        </div>        


<!--MODAL-->        
<div id="modalCreateUpdate" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <h2 class="uk-modal-title">Nova Atividade</h2>
        <button class="uk-modal-close" type="button"></button>
    </div>
</div>
        
        <!--scripts-->
        <script src='assets/js/uikit/js/uikit.min.js'></script>
        <script src='assets/js/MessagesHandler.js'></script>
        <script src='assets/js/ActivityService.js'></script>
        <script src='assets/js/main.js'></script>
        <script src='vendor/twbs/bootstrap/dist/js/bootstrap.min.js'></script>
    </body>
</html>

