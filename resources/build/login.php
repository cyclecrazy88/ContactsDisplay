<?php
namespace login_handler{

    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\DB;

    class Login{
        public $login = false;
        private $data = null;
        public $errorMessage = null;
        public function __construct($inputData){
            $this->data = $inputData;
            $this->authOrRegister();
        }

        private function authOrRegister(){
            if (is_array($this->data)){
                #echo "Auth: ".var_export($this->data,true)."\n";
                if (isset($this->data["register"]) && $this->data["register"] == "true" ){
                    #echo "Register...\n";

                    $userRecord = DB::table("users")->
                        where("name",$this->data["username"])->first();
                    #echo "Record: ".var_export($userRecord,true)."\n";
                    if ($userRecord){
                        $this->errorMessage = "Already Exists";
                        $passHash = hash('md5',$this->data["password"]);


                    }else{
                        //Password characters regex
                        // /^([a-z|0-9|?!!"£$%^&*()<>?,.//;'#:@~\[\]])$/

                        $currentDate = new \DateTime();
                        $formattedDate = $currentDate->format('Y-m-d H:i:s');
                        #echo "Update Date: $formattedDate\n";
                        $passHash = hash('md5',$this->data["password"]);
                        DB::table("users")->insert([
                            "name"=>$this->data["username"],
                            "password"=>$passHash,
                            "email"=>$this->data["email"],
                            "timestamp"=>$formattedDate
                        ]);
                    }

                }

                if (isset($this->data["username"]) && isset($this->data["password"])){
                    $username = $this->data["username"];
                    $password = $this->data["password"];
                    #echo "UserPass...\n";
                    if (strlen($username)==0){
                        $this->errorMessage = "No username provided";
                    }
                    else if (strlen($password)==0){
                        $this->errorMessage = "No password provided";
                    }else{
                        $passHash = Hash::make($password);
                        #echo "Hash: $passHash\n";
                        $this->authenticate();
                    }



                }else if(!(isset($this->data["username"]))){
                    #echo "No user...\n";
                    $this->errorMessage = "No username provided";
                }else if(!(isset($this->data["password"]))){
                    #echo "No pass...\n";
                    $this->errorMessage = "No password provided";
                }
            }
        }
        // ------------------------------------------
        // Authenticate the users ID for the item.
        // ------------------------------------------
        private function authenticate(){
            $passHash = hash('md5',$this->data["password"]);

            if (Auth::user()==false){
                #echo "Attempt to auth user...";
                $userRecord = DB::table("users")->
                    where("name",$this->data["username"])->first();
                #echo "Record: ".var_export($userRecord,true)."\n";

                if (isset($this->data["password"]) &&
                    $passHash == $this->data["password"]){
                    Auth::loginUsingId($this->data["id"]);
                    $this->login = true;
                }


            }else{
                echo "User:".var_dump(Auth::user())."\n";
                # echo "Already Logged In!\n";
                $this->login = true;
            }

        }
    }
}
?>
