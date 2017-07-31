<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Controle de Tarefas</title>
        <script src='assets/js/jquery-3.2.1.min.js'></script>
        <link rel='stylesheet' href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
        <link rel='stylesheet' href="assets/js/uikitv2/css/uikit.min.css">
        <link rel='stylesheet' href="assets/js/uikitv2/css/components/datepicker.min.css">
        <link rel='stylesheet' href="assets/js/uikitv2/css/components/notify.min.css">
    </head>
    <body>

        <div class="jumbotron">
          <div class="container">              

            <div class="panel panel-default">
              <div class="panel-heading">Lista de Atividades</div>
              <div class="panel-body">
                  
                  <!--Status Message (alert)-->
                  <p><button class='btn btn-primary actionButton' data-type='create'>Nova atividade</button></p>
                  <!--Status Message (alert)-->

                  <table class='table' id='activityList'></table>
              </div>
            </div>              
            
          </div>
        </div>        


        <!--MODAL-->        
        <!--<div id="modalCreateUpdate" uk-modal>-->
        <div id="modalCreateUpdate" class="uk-modal">
            <div class="uk-modal-dialog uk-modal-body">
                <h2 class="uk-modal-title">Atividade</h2>

                
                <form class="uk-form">

                    <div class="uk-grid">
                        <div class="uk-width-1-1">
                            <input type="text" placeholder="" class="uk-width-1-1" id="name">
                        </div>
                        <div class="uk-margin uk-width-1-2">
                            <input class="uk-margin uk-width-1-1" data-uk-datepicker="{format:'YYYY-MM-DD'}" type="text" placeholder="Data de início" id='start_date'>
                        </div>
                        <div class="uk-margin uk-width-1-2">
                            <input class="uk-margin uk-width-1-1" data-uk-datepicker="{format:'YYYY-MM-DD'}" type="text" placeholder="Data de finalização" id='end_date'>
                        </div>
                        <div class="uk-margin uk-width-1-1">
                            <textarea class="uk-textarea uk-width-1-1" rows="5" placeholder="Textarea" id='description'></textarea>
                        </div>
                        <div class="uk-margin uk-width-1-2">
                            <select class="uk-select uk-width-1-1" id='status'>
                                <option value="">Status...</option>
                                <option value="1">Pendente</option>
                                <option value="2">Em desenvolvimento</option>
                                <option value="3">Em teste</option>
                                <option value="4">Concluída</option>
                            </select>
                        </div>                            
                        <div class="uk-margin uk-width-1-2">
                            <select class="uk-select uk-width-1-1" id='state'>
                                <option value="">Situação...</option>
                                <option value="1">Ativa</option>
                                <option value="0">Inativa</option>
                            </select>
                        </div>                            

                    </div>
        
                </form>                
                <p class="uk-text-right">
                    <button class="uk-button uk-button-default uk-modal-close" type="button">Cancelar</button>
                    <button class="uk-button uk-button-primary actionButton" data-type="update" type="button">Salvar</button>
                </p>
            </div>
            
        </div>
        <!--end modal-->

        <!--scripts-->
        <script src='assets/js/uikitv2/js/uikit.min.js'></script>
        <script src='assets/js/uikitv2/js/components/datepicker.min.js'></script>
        <script src='assets/js/uikitv2/js/components/notify.min.js'></script>
        <script src='assets/js/BuildList.js'></script>
        <script src='assets/js/MessagesHandler.js'></script>
        <script src='assets/js/ActivityService.js'></script>
        <script src='assets/js/main.js'></script>
        <script src='vendor/twbs/bootstrap/dist/js/bootstrap.min.js'></script>
    </body>
</html>

