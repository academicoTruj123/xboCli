<?php

/* @var $this yii\web\View */

$this->title = 'Pagina comercial';
?>
<div class="site-index">
    <div class="jumbotron">
        <h1>EXPOBODA</h1>
        <p class="lead">Estamos trabajando</p>        
           <div class="row">
            <div class="col-lg-5" ></div>
            <div class="col-lg-2" >                
                    <div class="btn-group box-body no-padding">
                      <button type="button" class="btn btn-success btn-flat dropdown-toggle" data-toggle="dropdown"> 
                          Ingresar 
                        <span class="caret"></span>                        
                      </button>
                        
                            <ul class="dropdown-menu nav nav-pills nav-stacked" role="menu">
                              <li><a href="http://localhost:9091/login/cliente"><i class="fa fa-user"></i> como Cliente</a></li>                                
                              <li><a href="http://localhost:9091/login/empresa"><i class="fa fa-building"></i> como Empresa</a></li>                              
                              <li><a href="http://localhost:9091/login/administrador"><i class="fa fa-dashboard"></i> como Administrador</a></li>
                            </ul> 

                        
<!--                            <ul class="dropdown-menu nav nav-pills nav-stacked" role="menu">
                              <li><a href="http://flowers.pe/expoweb/backend/web/index.php?r=login%2Fcliente"><i class="fa fa-user"></i> como Cliente</a></li>                                
                              <li><a href="http://flowers.pe/expoweb/backend/web/index.php?r=login%2Fempresa"><i class="fa fa-building"></i> como Empresa</a></li>                              
                              <li><a href="http://flowers.pe/expoweb/backend/web/index.php?r=login%2Fadministrador"><i class="fa fa-dashboard"></i> como Administrador</a></li>
                            </ul> -->
                        
                    </div>              
            </div>
            <div class="col-lg-5" ></div>
        </div> 
    </div>
    <div class="body-content">     
    </div>
</div>
