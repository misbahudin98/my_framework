<?php


final class Session
{
    public function __construct(public string $name, public string $role, public int $last)
    {
    }
}


class SessionManager extends Controller
{

    private  static  string   $SECRET_KEY = "fjnljaicnuwe8nuwvo8nfulvieufksvfukenkfnelvnuf";
    private static $cookie_name = 'X-PZN-SESSION';
    private static $cookie_expired =  5*60;

    public static function login()
    {

        $data = new Controller;
        $hasil = $data->model('User_model')->login();
        if (is_array($hasil)) {

            $hasil = $hasil[0];
            $hasil['session'] = Security::pass_hash(uniqid());

            $data->model('User_model')->set_session($hasil);
            $jwt = self::jwt_encode($hasil, $hasil['session']);

            self::set_cookies($jwt);

            return true;
        } else {
            return false;
        }
    }


    public static function getCurrentUser(): Session
    {
        if (isset($_COOKIE[self::$cookie_name])) {
            try {

                $payload = self::jwt_decode();
                if (time() - $payload['last'] < self::$cookie_expired) {
                    $payload['last'] = time();
                    $jwt =  self::jwt_encode($payload, $payload['id']);

                    self::set_cookies($jwt);
                    return new Session(name: $payload['nama'], role: $payload['role'], last: time());
                } else {
                    self::logout();
                }
            } catch (Exception  $exception) {
                // throw new Exception("User is not login");
                header("location:" . BASEURL);
            }
        } else {

            header("location:" . BASEURL);
        }
    }

    public static function logout()
    {
        $url = self::url();
        $option = [
            'expires' => 1,
            'path' => '/',
            'domain' => $url[2],
            'secure' => true,
            'httponly' => true,
            'samesite' => 'strict'
        ];
        try {
            $payload = self::jwt_decode();
            $data = new Controller;
            $var = ['id' => $payload['id'], 'nama' => $payload['nama']];
            $var = $data->model('User_model')->delete_session($var);
            setcookie(self::$cookie_name, '', $option);
            header("Location:" . BASEURL);
        } catch (exception $exception) {
            header("Location:" . BASEURL . "home/logout");
        }
    }

    private static function set_cookies(string $value)
    {
        $url = self::url();
        $option = [
            // 'expires' => time() + self::$cookie_expired,
            'path' => '/',
            'domain' => $url[2],
            'secure' => true,
            'httponly' => true,
            'samesite' => 'strict'
        ];
        setcookie(self::$cookie_name, $value, $option);
    }


    private static function url()
    {
        return explode("/", BASEURL);
    }

    private static function jwt_encode(array $hasil, $id)
    {
        require_once "../app/libraries/vendor/autoload.php";

        $payload = [
            "id" => $id,
            "nama" => $hasil['nama'],
            "role" => $hasil['role'],
            "last" => time()  + self::$cookie_expired
        ];
        $jwt = \Firebase\JWT\JWT::encode($payload, self::$SECRET_KEY, 'HS256');
        return $jwt;
    }

    private static function jwt_decode()
    {
        require_once "../app/libraries/vendor/autoload.php";
        $jwt = $_COOKIE[self::$cookie_name];

        $payload =  \Firebase\JWT\JWT::decode($jwt, SessionManager::$SECRET_KEY, ['HS256']);
        return (array) $payload;
    }

    protected static function start()
    {
        $url = explode("/", BASEURL);
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start(
                [
                    'use_strict_mode' => true,
                    'cookie_domain' => $url[2],
                    'cookie_secure' => true,
                    'cookie_httponly' => true,
                    'cookie_samesite' => 'strict'
                ]
            );
        }
    }

    public static function token_form()
    {
        // //token form
        $token = bin2hex(random_bytes(35));
        self::start();
        $_SESSION['token'] = $token;
        $_SESSION['token_time'] = time();
    }
}
