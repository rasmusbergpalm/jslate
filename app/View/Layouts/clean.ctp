<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
    <?php echo $this->Html->charset(); ?>
    <head>
        <title>
            <?php echo $title_for_layout; ?>
        </title>
        <?php
            echo $this->Html->meta('icon');
            echo $this->Html->css('bootstrap.min');
            echo $this->Html->css('bootstrap-responsive.min');
            echo $this->Html->css('darkstrap-v0.9.0');
            echo $this->Html->css('jquery-ui');
            echo $this->Html->css('style');

            echo $this->Html->css('codemirror-3.14/codemirror');
            echo $this->Html->css('codemirror-3.14/ambiance');
            echo $this->Html->css('codemirror-3.14/hint/show-hint');

            echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js');
            echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js');
            echo $this->Html->script('bootstrap.min');

            echo $this->Html->script('codemirror-3.14/codemirror');
            echo $this->Html->script('codemirror-3.14/javascript');
            echo $this->Html->script('codemirror-3.14/xml');
            echo $this->Html->script('codemirror-3.14/css');
            echo $this->Html->script('codemirror-3.14/htmlmixed');

            echo $this->Html->script('codemirror-3.14/hint/show-hint.js');
            echo $this->Html->script('codemirror-3.14/hint/html-hint.js');
            echo $this->Html->script('codemirror-3.14/hint/javascript-hint.js');
            echo $this->Html->script('codemirror-3.14/hint/xml-hint.js');

            echo $this->Html->script('highstock');
            echo $this->Html->script('gray');

            echo $this->Html->script('d3/d3');
            echo $this->Html->script('d3/d3.csv');
            echo $this->Html->script('d3/d3.chart');
            echo $this->Html->script('d3/d3.geo');
            echo $this->Html->script('d3/d3.geom');
            echo $this->Html->script('d3/d3.layout');
            echo $this->Html->script('d3/d3.time');

            echo $scripts_for_layout;
        ?>
        <script type="text/javascript">
            $(document).ready(function(){
                $('.flashMessage').fadeIn(500).delay(5000).fadeOut(1000);
            });
            function proxy(url){
                return "<?php echo h(Router::url('/')) ?>"+'proxy.php?url='+encodeURIComponent(url);
            }

        </script>
        <script type="text/javascript">
          var _gaq = _gaq || [];
          _gaq.push(['_setAccount', 'UA-28317188-1']);
          _gaq.push(['_setDomainName', 'jslate.com']);
          _gaq.push(['_trackPageview']);

          (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
          })();
        </script>

    </head>

    <body>
        <?php echo $this->Session->flash(); ?>
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container">
                    <?php if(!empty($dblist)): ?>
                    <ul class="nav">
                        <?php if(!empty($dashboard_id)): ?>
                        <li class="active"><?php echo $this->Html->link($dblist[$dashboard_id], array('controller' => 'dashboards', 'action' => 'view', $dashboard_id)); ?></li>
                        <?php endif; ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dashboards <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><?php echo $this->Html->link('Add dashboard', array('controller'=>'dashboards', 'action'=>'add')); ?></li>
                                <li class="divider"></li>
                                <?php
                                    foreach ($dblist as $id => $name) {
                                        echo "<li>" . $this->Html->link($name, '/dashboards/view/' . $id) . "</li>";
                                    }
                                ?>
                            </ul>
                        </li>
                    </ul>
                    <?php endif; ?>
                    <ul class="nav pull-right">
                        <?php if(empty($user)): ?>
                            <li><div><?php echo $this->Html->link('Sign in', '/users/login/', array('class'=>'btn btn-primary', 'escape'=>false)); ?></div></li>
                        <?php elseif(strpos($this->here, 'dashboards/view') !== false): ?>
                            <li><?php echo $this->Html->link('Edit dashboard', '/dashboards/edit/'.$dashboard_id); ?></li>
                            <li class="divider-vertical"></li>
                            <li><div><?php echo $this->Html->link('<i class="icon-plus icon-white"></i> Add widget', '/dbviews/add/' . $dashboard_id, array('class'=>'btn btn-primary', 'escape'=>false)); ?></div></li>
                        <?php endif; ?>
                        <?php if(@strpos($user['email'],'jSlateDemoUser')!==false): ?>
                            <li class="divider-vertical"></li>
                            <li><div><?php echo $this->Html->link('<i class="icon-arrow-right icon-white"></i> Sign up', '/users/edit/', array('class'=>'btn btn-success', 'escape'=>false)); ?></div></li>
                        <?php endif; ?>
                    </ul>
                </div>

            </div><!-- /navbar-inner -->
        </div>

        <div class="container" id="content">
            <?php echo $content_for_layout; ?>
        </div>
    </body>
</html>

