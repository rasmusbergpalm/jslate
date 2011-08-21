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
                
                

                echo $this->Javascript->link('jquery');
                echo $this->Javascript->link('jquery-ui');

                echo $this->Javascript->link('flot/jquery.flot');

                echo $this->Javascript->link('codemirror/codemirror');
                echo $this->Javascript->link('codemirror/javascript');

                echo $this->Javascript->link('jquery.colorbox-min');
                echo $this->Javascript->link('highstock');
                //echo $this->Javascript->link('highcharts');
                echo $this->Javascript->link('jquery.editable-1.3.3.min');

                echo $this->Html->css('codemirror/codemirror');
                echo $this->Html->css('codemirror/default');
                echo $this->Html->css('colorbox');
                echo $this->Html->css('topnav');


		echo $scripts_for_layout;
            ?>
            <script type="text/javascript">
                $(document).ready(function(){
                    window.setTimeout(function(){
                        $('#flashMessage').toggle('slow');
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

	</head>

	<body>
        <?php echo $this->Session->flash(); ?>
        <?php
            $quotes = Array(
                'Without data you\'re just a guy with an opinion'
            );
        ?>

		<div id="header">
                    <small style="float: right; color: white; text-align: right; padding-right: 5px;">
                        <?php echo $quotes[rand(0, count($quotes)-1)]; ?>
                        <br />
                        firehose v. 0.1a
                    </small>
                    <span style="float: left; color: white;">
                        <ul class="topnav">
                            <li>
                                <a><?php echo (!empty($dashboard_id) ? $dblist[$dashboard_id] : 'Dashboards'); ?></a>
                                <ul class="subnav">
                                    <?php
                                        foreach($dblist as $id => $name){
                                            echo "<li>".$this->Html->link($name, '/dashboards/view/'.$id)."</li>";
                                        }
                                    ?>
                                </ul>
                            </li>
                            <?php if(!empty($dashboard_id)): ?>
                                <li><a><?php echo $this->Html->link('Add widget', '/dbviews/add/'.$dashboard_id); ?></a></li>
                            <?php endif ?>
                        </ul>
                        
                            
                        
                    </span>
		</div>

                

		<div id="content">
                    <div id="wrap">

                    <?php echo $content_for_layout; ?>
                        </div>
		</div>
            <?php echo $this->element('sql_dump'); ?>
	</body>
</html>

