<?php
namespace Contacts_Entries{

    use Illuminate\Support\Facades\DB;

    class GetContactsList{
        public $token = null;
        public $list = null;

        public function __construct(){
            // Update Token
            $this->token = csrf_token();
            // Data List
            $this->list = $this->getData();
        }

        private function getData(){
            $contactList = DB::table('ContactsList')->get();
            return $contactList;
        }

    }

    class UpdateContactsList{
        public $insertId = null;
        public function __construct($inputArray){
            $this->insertId = $this->insertData($inputArray);
        }
        private function insertData($inputArray){
            $contactList = DB::table('ContactsList')->insertGetId([
                "email"=>$inputArray["email"],
                "phone"=>$inputArray["phone"],
                "mobile"=>$inputArray["mobile"],
                "name"=>$inputArray["name"],
                "city"=>$inputArray["city"],
                "country"=>$inputArray["country"],
                "postcode"=>$inputArray["postcode"],
                "state"=>$inputArray["state"],
                "thumbnail"=>$inputArray["thumbnail"]
            ]);
            return $contactList;
        }
    }
}
?>
