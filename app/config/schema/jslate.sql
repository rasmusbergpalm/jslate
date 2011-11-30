-- phpMyAdmin SQL Dump
-- version 3.3.2deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 22, 2011 at 03:22 AM
-- Server version: 5.1.41
-- PHP Version: 5.3.2-1ubuntu4.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `jslate`
--

-- --------------------------------------------------------

--
-- Table structure for table `dashboards`
--

CREATE TABLE IF NOT EXISTS `dashboards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `dashboards`
--

INSERT INTO `dashboards` (`id`, `name`) VALUES
(6, 'example');

-- --------------------------------------------------------

--
-- Table structure for table `dbviews`
--

CREATE TABLE IF NOT EXISTS `dbviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dashboard_id` int(11) NOT NULL,
  `left` int(11) NOT NULL,
  `top` int(11) NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `code` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `dashboard_id` (`dashboard_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=40 ;

--
-- Dumping data for table `dbviews`
--

INSERT INTO `dbviews` (`id`, `name`, `dashboard_id`, `left`, `top`, `width`, `height`, `code`) VALUES
(38, 'highchart-combi.js', 6, 20, 360, 1143, 275, 'var chart = new Highcharts.Chart({\n  chart: {\n     renderTo: viewid,\n     zoomType: ''xy''\n  },\n  title: {\n     text: ''Average Monthly Weather Data for Tokyo''\n  },\n  subtitle: {\n     text: ''Source: WorldClimate.com''\n  },\n  xAxis: [{\n     categories: [''Jan'', ''Feb'', ''Mar'', ''Apr'', ''May'', ''Jun'',\n        ''Jul'', ''Aug'', ''Sep'', ''Oct'', ''Nov'', ''Dec'']\n  }],\n  yAxis: [{ // Primary yAxis\n     labels: {\n        formatter: function() {\n           return this.value +''Ã‚Â°C'';\n        },\n        style: {\n           color: ''#89A54E''\n        }\n     },\n     title: {\n        text: ''Temperature'',\n        style: {\n           color: ''#89A54E''\n        }\n     },\n     opposite: true\n\n  }, { // Secondary yAxis\n     gridLineWidth: 0,\n     title: {\n        text: ''Rainfall'',\n        style: {\n           color: ''#4572A7''\n        }\n     },\n     labels: {\n        formatter: function() {\n           return this.value +'' mm'';\n        },\n        style: {\n           color: ''#4572A7''\n        }\n     }\n\n  }, { // Tertiary yAxis\n     gridLineWidth: 0,\n     title: {\n        text: ''Sea-Level Pressure'',\n        style: {\n           color: ''#AA4643''\n        }\n     },\n     labels: {\n        formatter: function() {\n           return this.value +'' mb'';\n        },\n        style: {\n           color: ''#AA4643''\n        }\n     },\n     opposite: true\n  }],\n  tooltip: {\n     formatter: function() {\n        var unit = {\n           ''Rainfall'': ''mm'',\n           ''Temperature'': ''Ã‚Â°C'',\n           ''Sea-Level Pressure'': ''mb''\n        }[this.series.name];\n\n        return ''''+\n           this.x +'': ''+ this.y +'' ''+ unit;\n     }\n  },\n  legend: {\n     layout: ''vertical'',\n     align: ''left'',\n     x: 120,\n     verticalAlign: ''top'',\n     y: 80,\n     floating: true,\n     backgroundColor: ''#FFFFFF''\n  },\n  series: [{\n     name: ''Rainfall'',\n     color: ''#4572A7'',\n     type: ''column'',\n     yAxis: 1,\n     data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]\n\n  }, {\n     name: ''Sea-Level Pressure'',\n     type: ''spline'',\n     color: ''#AA4643'',\n     yAxis: 2,\n     data: [1016, 1016, 1015.9, 1015.5, 1012.3, 1009.5, 1009.6, 1010.2, 1013.1, 1016.9, 1018.2, 1016.7],\n     marker: {\n        enabled: false\n     },\n     dashStyle: ''shortdot''\n\n  }, {\n     name: ''Temperature'',\n     color: ''#89A54E'',\n     type: ''spline'',\n     data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]\n  }]\n});'),
(37, 'highstock-multi-lines.js', 6, 20, 40, 564, 301, '\n    var seriesOptions = [],\n        yAxisOptions = [],\n        seriesCounter = 0,\n        names = [''MSFT'', ''AAPL'', ''GOOG''],\n        colors = Highcharts.getOptions().colors;\n\n    $.each(names, function(i, name) {\n\n        $.getJSON(''http://www.highcharts.com/samples/data/jsonp.php?filename=''+ name.toLowerCase() +''-c.json&callback=?'',    function(data) {\n\n            seriesOptions[i] = {\n                name: name,\n                data: data\n            };\n\n            // As we''re loading the data asynchronously, we don''t know what order it will arrive. So\n            // we keep a counter and create the chart when all the data is loaded.\n            seriesCounter++;\n\n            if (seriesCounter == names.length) {\n                createChart();\n            }\n        });\n    });\n\n\n\n    // create the chart when all data is loaded\n    function createChart() {\n\n        chart = new Highcharts.StockChart({\n            chart: {\n                renderTo: viewid\n            },\n\n            rangeSelector: {\n                selected: 4\n            },\n\n            yAxis: {\n                labels: {\n                    formatter: function() {\n                        return (this.value > 0 ? ''+'' : '''') + this.value + ''%'';\n                    }\n                },\n                plotLines: [{\n                    value: 0,\n                    width: 2,\n                    color: ''silver''\n                }]\n            },\n            \n            plotOptions: {\n                series: {\n                    \n                    compare: ''percent''\n                }\n            },\n            \n            tooltip: {\n                pointFormat: ''<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.change}%)<br/>'',\n                yDecimals: 2\n            },\n            \n            series: seriesOptions\n        });\n    }\n\n\n'),
(36, 'highchart-area.js', 6, 600, 40, 563, 301, 'var chart = new Highcharts.Chart({\n      chart: {\n         renderTo: viewid, \n         defaultSeriesType: ''area''\n      },\n      title: {\n         text: ''US and USSR nuclear stockpiles''\n      },\n      subtitle: {\n         text: ''Source: <a href="http://thebulletin.metapress.com/content/c4120650912x74k7/fulltext.pdf">''+\n            ''thebulletin.metapress.com</a>''\n      },\n      xAxis: {\n         labels: {\n            formatter: function() {\n               return this.value; // clean, unformatted number for year\n            }\n         }                     \n      },\n      yAxis: {\n         title: {\n            text: ''Nuclear weapon states''\n         },\n         labels: {\n            formatter: function() {\n               return this.value / 1000 +''k'';\n            }\n         }\n      },\n      tooltip: {\n         formatter: function() {\n            return this.series.name +'' produced <b>''+\n               Highcharts.numberFormat(this.y, 0) +''</b><br/>warheads in ''+ this.x;\n         }\n      },\n      plotOptions: {\n         area: {\n            pointStart: 1940,\n            marker: {\n               enabled: false,\n               symbol: ''circle'',\n               radius: 2,\n               states: {\n                  hover: {\n                     enabled: true\n                  }\n               }\n            }\n         }\n      },\n      series: [{\n         name: ''USA'',\n         data: [null, null, null, null, null, 6 , 11, 32, 110, 235, 369, 640, \n            1005, 1436, 2063, 3057, 4618, 6444, 9822, 15468, 20434, 24126, \n            27387, 29459, 31056, 31982, 32040, 31233, 29224, 27342, 26662, \n            26956, 27912, 28999, 28965, 27826, 25579, 25722, 24826, 24605, \n            24304, 23464, 23708, 24099, 24357, 24237, 24401, 24344, 23586, \n            22380, 21004, 17287, 14747, 13076, 12555, 12144, 11009, 10950, \n            10871, 10824, 10577, 10527, 10475, 10421, 10358, 10295, 10104 ]\n      }, {\n         name: ''USSR/Russia'',\n         data: [null, null, null, null, null, null, null , null , null ,null, \n         5, 25, 50, 120, 150, 200, 426, 660, 869, 1060, 1605, 2471, 3322, \n         4238, 5221, 6129, 7089, 8339, 9399, 10538, 11643, 13092, 14478, \n         15915, 17385, 19055, 21205, 23044, 25393, 27935, 30062, 32049, \n         33952, 35804, 37431, 39197, 45000, 43000, 41000, 39000, 37000, \n         35000, 33000, 31000, 29000, 27000, 25000, 24000, 23000, 22000, \n         21000, 20000, 19000, 18000, 18000, 17000, 16000]\n      }]\n});\n');

