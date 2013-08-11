<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

/*
| -------------------------------------------------------------------------
| This is a customized code to handle dynamic loading of page.
| -------------------------------------------------------------------------
*/

//routing for js files
$route['global.js']="js/index";

//routing for css files
$route['global.css']="css/index";
$route['jquery-ui.css']="css/jquery_ui";

//routing for organisms
$route['organism/([a-z|A-Z|_|\-]+)']="organism/query_name/$1";
$route['organism/([a-z|A-Z|_|\-]+)/([a-z|A-Z|_|\-]+)']="organism/query_species/$1/$2";
$route['organism/([0-9]+)']="organism/query_id/$1";

session_start();

$route['default_controller']="home";
if(!isset($_SESSION['user']))
	$route['profile']="home";

session_commit();


//$route['default_controller'] = "welcome";
$route['404_override'] = '';

/* End of file routes.php */
/* Location: ./application/config/routes.php */