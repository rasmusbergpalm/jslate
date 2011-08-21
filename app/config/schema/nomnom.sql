-- phpMyAdmin SQL Dump
-- version 3.3.2deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 21, 2011 at 08:18 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.2-1ubuntu4.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `nomnom`
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
(2, 'sdfsd'),
(6, 'New Dashboard');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=28 ;

--
-- Dumping data for table `dbviews`
--

INSERT INTO `dbviews` (`id`, `name`, `dashboard_id`, `left`, `top`, `width`, `height`, `code`) VALUES
(12, 'bergpalm.dk http latency last 2 hours', 2, 0, 0, 589, 214, 'var tag = ''bergpalm.dk''\r\nvar something = ''latency'';\r\nvar interval = 10; //seconds\r\nvar range = 60*60*2; //seconds\r\n\r\nvar startkey = "[%22"+tag+"%22,"+(new Date().getTime() - range*1000)+"]";\r\nvar endkey = "[%22"+tag+"%22,"+(new Date().getTime())+"]";\r\n\r\nvar url = "/couchdb/data/_design/tagsdate/_view/tagsdate?startkey="+startkey+"&endkey="+endkey;\r\n$.ajax({\r\n    type: "GET",\r\n    url: url,\r\n    dataType: ''json'',\r\n    success: function(msg){\r\n        console.log(msg.rows.length);\r\n        var i=0;\r\n        d=[];\r\n        $.each(msg.rows, function(k,r){\r\n            d.push([r.value.date, r.value.latency]);	\r\n        });\r\n        $.plot($(''#''+viewid), [{data: d, color: ''red'', bars: { show: true }}],{xaxis: { mode: "time" }});\r\n    }\r\n});\r\n\r\nvar lastFetch = new Date().getTime();\r\n    \r\nfunction plotDelta(){\r\n    var startkey = "[%22"+tag+"%22,"+(lastFetch)+"]";\r\n    var endkey = "[%22"+tag+"%22,"+(new Date().getTime())+"]";\r\n    \r\n    var url = "/couchdb/data/_design/tagsdate/_view/tagsdate?startkey="+startkey+"&endkey="+endkey;\r\n    $.ajax({\r\n        type: "GET",\r\n        url: url,\r\n        dataType: ''json'',\r\n        success: function(msg){\r\n            console.log(msg.rows.length);\r\n            var i=0;\r\n            $.each(msg.rows, function(k,r){\r\n                d.shift();\r\n                d.push([r.value.date, r.value.latency]);	\r\n            });\r\n            $.plot($(''#''+viewid), [{data: d, color: ''red'', bars: { show: true }}],{xaxis: { mode: "time" }});\r\n        }\r\n    });\r\n    lastFetch = new Date().getTime();\r\n\r\n}\r\n\r\nwindow.setInterval(plotDelta,interval*1000);\r\n'),
(27, 'couchdb httpd requests', 2, 620, -284, 318, 223, 'var tag = ''bergpalm.dk''\r\nvar something = ''latency'';\r\nvar interval = 10; //seconds\r\nvar range = 60*60*2; //seconds\r\n\r\nvar d = [];\r\nvar url = "/couchdb/_stats?range=60";\r\nfunction draw(){\r\n    $.ajax({\r\n    type: "GET",\r\n    url: url,\r\n    dataType: ''json'',\r\n    success: function(msg){\r\n        d.push([new Date().getTime(), msg.httpd.requests.mean]);\r\n        if(d.length > (range/interval)){\r\n            d.shift();\r\n        }\r\n        $.plot($(''#''+viewid), [{data: d, color: ''red'', bars: { show: true }}],{xaxis: { mode: "time" }});\r\n    }\r\n});\r\n\r\n}\r\ndraw()\r\nwindow.setInterval(draw,interval*1000);');

-- --------------------------------------------------------

--
-- Table structure for table `getters`
--

CREATE TABLE IF NOT EXISTS `getters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `interval` int(11) NOT NULL,
  `code` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `getters`
--

INSERT INTO `getters` (`id`, `name`, `description`, `interval`, `code`) VALUES
(1, 'http(s) get request', 'performs a http get request to site, returns response codes and latency', 10, '//options\r\nvar options = {\r\n        host: ''193.202.110.23'',\r\n        port: ''80'',\r\n        path: ''/'',\r\n        headers: {''host'': ''bergpalm.dk''}\r\n    };\r\nvar result = {''tags'': [''latency'', ''http_status_code'',''bergpalm.dk'']};\r\nvar protocol = ''http'';\r\n\r\n//code\r\nvar req_lib = require(protocol);\r\n\r\nvar startTime = new Date().getTime();\r\n\r\nvar req = req_lib.get(options, function(res) {\r\n    res.on(''error'', function(err){\r\n        saveResults(result, startTime, err.message);\r\n    });\r\n    res.on(''end'', function(){\r\n        saveResults(result, startTime, res.statusCode);\r\n    });\r\n});\r\n\r\nreq.on(''end'', function(err){\r\n    saveResults(result, startTime, err.message);\r\n});\r\nreq.on(''error'',function(err){\r\n    saveResults(result, startTime, err.message);\r\n});\r\n\r\nfunction saveResults(result, startTime, status){\r\n    var now = new Date().getTime();\r\n    result.latency =  now - startTime;\r\n    result.status = status;\r\n\r\n    save(result);\r\n}\r\n\r\n    \r\n    \r\n');
