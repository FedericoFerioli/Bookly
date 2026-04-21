<?php  
defined('APP') or die('Acceso negato');
?>
<?php 
require_once __DIR__ . '/../../config/dbconnect.php';
class ViewlistingModel{
    private $pdo;
    public function __construct(){
        $this->pdo = DB::connect();
    }

    public function getOne($id) {
        $dql = "SELECT insertions.*, books.title, books.authors, books.publisher, users.name AS `name`, users.surname AS `surname`, subjects.name AS subject_name
            FROM insertions 
            LEFT JOIN books USING(book_id) 
            LEFT JOIN users ON insertions.selling_user = users.user_id
            LEFT JOIN subjects USING(subject_id)
            WHERE insertions.insertion_id = ?
            LIMIT 1";

    $param=[$id];
    $stm = $this->pdo->prepare($dql);
    $stm->execute($param);
    
    return $stm->fetch(PDO::FETCH_ASSOC);
    }

    public function filter($pmin,$pmax,$cname,$sname,$condition,$clyear): array{
        $dql="SELECT insertions.*, books.title, books.authors, books.publisher, users.name AS `name`, users.surname AS `surname`, subjects.name AS subject_name
            FROM insertions
            JOIN courses USING(course_id)
            JOIN classes_courses USING(course_id)
            JOIN classes USING(class_id)
            LEFT JOIN books USING(book_id) 
            LEFT JOIN users ON insertions.selling_user = users.user_id
            LEFT JOIN subjects USING(subject_id)
            WHERE 1=1";
        $params=[];
        if(!empty($pmin) and !empty($pmax)){
            $dql.="AND insertions.price BETWEEN :pmin AND :pmax";
            $params[':pmin']=$pmin;
            $params[':pmax']=$pmax;
        }
        else if(!empty($pmin)){
            $dql.="AND insertions.price>=:pmin";
            $params[':pmin']=$pmin;
        }
        else if(!empty($pmax)){
            $dql.="AND insertions.price<=:pmax";
            $params[':pmax']=$pmax;
        }
        if(!empty($cname)){
            $dql.="AND courses.name =:cname";
            $params[':cname']=$cname;
        }
        if(!empty($sname)){
            $dql.="AND subjects.name=:sname";
            $params[':sname']=$sname;
        }
        if(!empty($condition)){
            $dql.="AND insertions.book_condition=:condition";
            $params[':condition']=$condition;
        }
        if(!empty($clyear)){
            $dql.="AND classes.year>=:clyear";
            $params[':clyear']=$clyear;
        }
    }
}

