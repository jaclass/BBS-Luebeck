<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/model/discussion.php';
require __DIR__ . '/model/comment.php';
require __DIR__ . '/dbconnection/dbUtil.php';

session_start();

$app = AppFactory::create();
$COMMON_PATH='/BBS_Server/public/'; /*if the folder BBS_Server is not directly in the htdocs, you need to adjust this*/


$app->group($COMMON_PATH.'user', function (RouteCollectorProxy $group) {
    /* router for user login*/
    /* ex: [GET]http://localhost/BBS_Server/public/user/login/username=le&&password=3456788 */
    $group->get('/login/username={username}&&password={password}', function ($request, $response, $args) {      
        $user_array = dbUtil::login($args['username'], $args['password']);
        $response->getBody()->write(json_encode($user_array));
        if(!array_key_exists("error", $user_array)){
            $_SESSION["user"]=$user_array;
        }
        return $response
            ->withHeader('Content-Type', 'application/json');
    });
    
    /* router for creating user*/
    /* ex: [POST]http://localhost/BBS_Server/public/user/create; with params {user:user,password:password,img_url:img_url} */
    $group->post('/create', function ($request, $response, $args) {
        $params = $request->getQueryParams();
        $user_json = dbUtil::user_create($params['username'], $params['password'], $params['img_url']);
        $response->getBody()->write(json_encode($user_json));
        return $response
            ->withHeader('Content-Type', 'application/json');
    });
    
    /* router for log out*/
    /* ex: [GET]http://localhost/BBS_Server/public/user/logout; no params*/
    $group->post('/logout', function ($request, $response, $args) {
        if(isset($_SESSION["user"])){   //release the session
            unset($_SESSION["user"]);
        }
        $response->getBody()->write(json_encode(array("state"=>"logout")));
        return $response
            ->withHeader('Content-Type', 'application/json');
    });
    
/*     $group->get('/checksession', function ($request, $response, $args) {
        $response->getBody()->write(json_encode($_SESSION["user"]));
        return $response
            ->withHeader('Content-Type', 'application/json');
    });
         */

});

$app->group($COMMON_PATH.'discussion', function (RouteCollectorProxy $group) {
    /* router for searching discussion
     *  ex: [POST]http://localhost/BBS_Server/public/discussion/search?discussion_name=gt&label=java&user=0&user_id=4257&order=comment_number&page_num=1; 
     * Ignore the attribute if it is not needed 
     * user=1 means using the user_id stored in session for searching
     * like: [POST]http://localhost/BBS_Server/public/discussion/search?label=php&user=1&order=comment_number&page_num=1;
    */
    $group->get('/search', function ($request, $response, $args) {
        $params = $request->getQueryParams();
        if($params["user"]==1 && isset($_SESSION["user"])){
            $user_id = ($_SESSION["user"])["id"];
            $params["user_id"]=$user_id;
        }
        $result = dbUtil::discussion_search($params);
        $response->getBody()->write(json_encode($result));
        return $response
            ->withHeader('Content-Type', 'application/json');
    }); 
    
    /* router for creating discussion
     *  ex: [POST]http://localhost/BBS_Server/public/discussion/create?discussion_name=what is the best master program in USA?&label=graduate study&discription=some contents here.*/
    $group->post('/create', function($request, $response, $args) {
        $params = $request->getQueryParams();
        $result = dbUtil::discussion_create($_SESSION["user"]["id"], $params["discussion_name"], $params["discription"], $params["label"]);
        $response->getBody()->write(json_encode($result));
        return $response
            ->withHeader('Content-Type', 'application/json');
    });
    
    /* router for updating discussion 
     * ex: [PUT]http://localhost/BBS_Server/public/discussion/update?discussion_name=what is CE?&label=graduate study&discription=some contents here.&discussion_id=18
     * all attributes MUST BE specified!
     */
    $group->put('/update', function($request, $response, $args) {
        $params = $request->getQueryParams();
        if(!isset($_SESSION["user"])){
            $response->getBody()->write(json_encode(array("error"=>"authority error")));
            return $response
                ->withHeader('Content-Type', 'application/json');
        }
        $result = dbUtil::discussion_update($_SESSION["user"]["id"], $params["discussion_id"], $params["discussion_name"], $params["discription"], $params["label"]);
        $response->getBody()->write(json_encode($result));
        return $response
            ->withHeader('Content-Type', 'application/json');
    });
    
    /* router for deleting discussion
     * ex: [PUT]http://localhost/BBS_Server/public/discussion/delete?discussion_id=18
     * user session MUST be set
     */
    $group->put('/delete', function($request, $response, $args) {
        $params = $request->getQueryParams();
        if(!isset($_SESSION["user"])){
            $response->getBody()->write(json_encode(array("error"=>"authority error")));
            return $response
                ->withHeader('Content-Type', 'application/json');
        }
        $result = dbUtil::discussion_delete($_SESSION["user"]["id"], $params["discussion_id"]);
        $response->getBody()->write(json_encode($result));
        return $response
            ->withHeader('Content-Type', 'application/json');
    });
});

/*user can only view/add comment
 *delete/update is not allow 
 */
$app->group($COMMON_PATH.'comment', function (RouteCollectorProxy $group) {
    
    /* router for search comment by discussion_id
     * ex: [GET]http://localhost/BBS_Server/public/comment/search?discussion_id=2
     */
    $group->get('/search', function ($request, $response, $args) {
        $params = $request->getQueryParams();
        if(!array_key_exists("discussion_id", $params)){
            $response->getBody()->write(json_encode(array("error"=>"wrong parameters")));
            return $response
                ->withHeader('Content-Type', 'application/json');
        }
        $user_id = isset($_SESSION["user"])?$_SESSION["user"]["id"]:NULL;
        $result = dbUtil::comment_search($params["discussion_id"], $user_id);
        $response->getBody()->write(json_encode($result));
        return $response
            ->withHeader('Content-Type', 'application/json');
    });
    
    /* router for create comment 
     * ex: [POST]http://localhost/BBS_Server/public/comment/create?content=what is up&img_url=&discussion_id=2&pre_comment_id=-1
     * if it is not a reply, you MUST set pre_comment_id as -1
     */
    $group->post('/create', function ($request, $response, $args) {
        $params = $request->getQueryParams();
        if(!isset($_SESSION["user"])){  // without login
            $response->getBody()->write(json_encode(array("error"=>"authority error")));
            return $response
                ->withHeader('Content-Type', 'application/json');
        }
        
        if(!array_key_exists("content", $params)||!array_key_exists("img_url", $params)
            ||!array_key_exists("discussion_id", $params)||!array_key_exists("pre_comment_id", $params)){   //wrong parameters 
            $response->getBody()->write(json_encode(array("error"=>"parameters error")));
            return $response
                ->withHeader('Content-Type', 'application/json');
        }
        
        $result = dbUtil::comment_create($params["content"], $params["img_url"], $params["discussion_id"], $params["pre_comment_id"], $_SESSION["user"]["id"]);
        $response->getBody()->write(json_encode($result));
        return $response
            ->withHeader('Content-Type', 'application/json');
    });
    
    /* router for like/unlike comment
     * ex: http://localhost/BBS_Server/public/comment/like?comment_id=25&like=1
     * like -> like=1; unlike -> like=-1
     */
    $group->post('/like', function ($request, $response, $args) {
        $params = $request->getQueryParams();
        if(!isset($_SESSION["user"])){  // without login
            $response->getBody()->write(json_encode(array("error"=>"authority error")));
            return $response
            ->withHeader('Content-Type', 'application/json');
        }
        if(!array_key_exists("comment_id", $params)||!array_key_exists("like", $params)){   // wrong parameter
            $response->getBody()->write(json_encode(array("error"=>"wrong parameters, 'comment_id' and 'like' is required")));
            return $response
            ->withHeader('Content-Type', 'application/json');
        }
        $result = dbUtil::evaluation_update($params["comment_id"],  $_SESSION["user"]["id"], $params["like"]);
        $response->getBody()->write(json_encode($result));
        return $response
            ->withHeader('Content-Type', 'application/json');
        
    });

        
});


    
$app->run();