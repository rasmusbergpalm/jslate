<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
    <?php echo $this->Html->charset(); ?>
    <head>
        <title>
            <?php echo $title_for_layout; ?>
        </title>
        <?php
            echo $this->Html->meta('icon');

            echo $this->Html->css('clean');
            echo $this->Html->css('jquery-ui');

            echo $this->Html->css('codemirror-3.14/codemirror');
            echo $this->Html->css('codemirror-3.14/ambiance');
            echo $this->Html->css('codemirror-3.14/hint/show-hint');
            echo $this->Html->css('colorbox');
            echo $this->Html->css('topnav');

            echo $this->Html->script('jquery');
            echo $this->Html->script('jquery-ui');
            echo $this->Html->script('jquery.colorbox-min');

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
                    $('.cbox').colorbox();

                    window.setTimeout(function(){
                        $('#flashMessage').toggle('slow');
                        $('#authMessage').toggle('slow');
                    }, 5000);

                    $("ul.subnav").parent().append("<span></span>"); //Only shows drop down trigger when js is enabled (Adds empty span tag after ul.subnav*)

                    $("ul.topnav li span").click(function() { //When trigger is clicked...

                        //Following events are applied to the subnav itself (moving subnav up and down)
                        $(this).parent().find("ul.subnav").slideDown('fast').show(); //Drop down the subnav on click

                        $(this).parent().hover(function() {
                        }, function(){
                            $(this).parent().find("ul.subnav").slideUp('slow'); //When the mouse hovers out of the subnav, move it back up
                        });

                        //Following events are applied to the trigger (Hover events for the trigger)
                    }).hover(function() {
                        $(this).addClass("subhover"); //On hover over, add class "subhover"
                    }, function(){	//On Hover Out
                        $(this).removeClass("subhover"); //On hover out, remove class "subhover"
                    });

                });

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
            <?php echo $this->Session->flash('auth'); ?>
            <div id="header">
                <?php if (!empty($dashboard_id)): ?>
                <span style="float: left; color: white;">
                    <ul class="topnav">    
                        <li>
                            <?php
                                echo $this->Html->link($dblist[$dashboard_id], array('controller' => 'dashboards', 'action' => 'view', $dashboard_id));
                            ?>
                            <ul class="subnav">
                                <?php
                                foreach ($dblist as $id => $name) {
                                    echo "<li>" . $this->Html->link($name, '/dashboards/view/' . $id) . "</li>";
                                }
                                ?>
                            </ul>
                        </li>
                        
                    </ul>
                </span>
                <span style="float: right; color: white; margin-right: 60px;">
                    <ul class="topnav">

                            <li><?php echo $this->Html->link($this->Html->image("add.png", array('style'=>'width: 32px; margin-top:-8px; float: left;')).' Create widget', '/dbviews/add/' . $dashboard_id, array('escape' =>false)); ?></li>
                            <li>
                                <a>Config<?php echo $this->Html->image("config.png", array('style'=>'width: 32px; margin-top:-8px; float: left;')); ?> </a>
                                <ul class="subnav">
                                    <li><?php echo $this->Html->link('Add dashboard', "/dashboards/add/", array('class' => 'cbox')); ?></li>
                                    <li><?php echo $this->Html->link('Edit dashboard', "/dashboards/edit/$dashboard_id", array('class' => 'cbox')); ?></li>
                                </ul>
                            </li>

                    </ul>
                </span>
                <?php endif ?>
            </div>



        <div id="content">
            <div id="wrap">
                <?php echo $content_for_layout; ?>
            </div>
        </div>
        <?php echo $this->element('sql_dump'); ?>
    </body>
</html>

