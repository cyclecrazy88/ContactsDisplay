<?php
namespace comments{

    use Illuminate\Support\Facades\DB;

    class update{
        public $update = true;
        public function __construct($data){
            $this->comment_update($data);
        }

        private function comment_update($data){
            echo "Update: ".var_export($data)."\n";
            if (isset($data["code"]) && isset($data["comment"]) ){
                $key = $data["code"];
                $comment = $data["comment"];
                echo "Key $key Comment: $comment";

                DB::table("CommentsList")->upsert([
                    "key"=>$key,
                    "comment"=>$comment
                ],["key"]);
            }
        }
    }
}

?>
