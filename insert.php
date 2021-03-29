<?php
   //validating empty fields

    $required_fields = [
        'first_name',
        'last_name',
        'address_1',
        'city',
        'province',
        'country',
        'postal_code',
        'email',
        'country_code',
        'area_code',
        'phone_number'
    ];

    foreach ($required_fields as $field) {
        //check $_POST[$field]是不是empty
        if (empty($_POST[$field])) {

            echo "<br>The {$field} cannot be empty";
            exit;
        }
    }
    //check the $_POST['email']是不是valid email address .filter_var如果是正确的，就返回sanitizate的值，如果是错误的，
    //那就直接返回false
    if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
        echo"<br> The Email isn't in a valid format, Please correct it<br/>";
        exit;
    }
    //validation is ok

    //sanitization is crucial to the integrity of our application
    //php清理了用户输入
    foreach ($required_fields as $field) {
        $_POST[$field] = filter_var($_POST[$field],FILTER_SANITIZE_STRING);

    }
    $_POST['email'] = filter_var($_POST['email'],FILTER_VALIDATE_EMAIL);
    var_dump($_POST);

    //example；假设这里first_name输入的是 <script></script>的类型，那么 经过了sanitize之后，javascript的文件就无法执行了，
    //thwart潜在的hack

    //sanitization is meh

    //Normalization
    foreach ($required_fields as $field){
        //三等于，是完全比较，不仅比较值，还比较值的类型,这里我们skip email address
        if($field ==="email") continue;
        //to lower case
        $_POST[$field] = strtolower($_POST[$field]);
        // 首字母大写
        $_POST[$field] = ucwords($_POST[$field]);

    }

    var_dump($_POST);

    //connect and insert into our database，这里include了_connect的page，并且调用了里面的function
    include ('_connect.php');
    $conn = connect();

    $sql ="INSERT  INTO  contacts(
            first_name,
            last_name,
            email,
            country_code,
            area_code,
            phone_number,
            address_1,
            address_2,
            city,
            province,           
            country,          
            postal_code   
            ) VALUES (
            :first_name,
            :last_name,
            :email,
            :country_code,
            :area_code,
            :phone_number,
            :address_1,
            :address_2,
            :city,
            :province,           
            :country,          
            :postal_code
                      
            )";
    //prepare 准备执行一个sql语句，并且返回一个PODstatement对象，
    //bindParam是PDOStatement的一个方法，用于在PDO操作中绑定占位符的内容，进行替换，是PDO安全性的一大保障。
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':first_name',$_POST['first_name'],PDO::PARAM_STR);
    $stmt->bindParam(':last_name',$_POST['last_name'],PDO::PARAM_STR);
    $stmt->bindParam(':email',$_POST['email'],PDO::PARAM_STR);
    $stmt->bindParam(':country_code',$_POST['country_code'],PDO::PARAM_STR);
    $stmt->bindParam(':area_code',$_POST['area_code'],PDO::PARAM_STR);
    $stmt->bindParam(':phone_number',$_POST['phone_number'],PDO::PARAM_STR);
    $stmt->bindParam(':address_1',$_POST['address_1'],PDO::PARAM_STR);
    $stmt->bindParam(':address_2',$_POST['address_2'],PDO::PARAM_STR);
    $stmt->bindParam(':city',$_POST['city'],PDO::PARAM_STR);
    $stmt->bindParam(':province',$_POST['province'],PDO::PARAM_STR);
    $stmt->bindParam(':country',$_POST['country'],PDO::PARAM_STR);
    $stmt->bindParam(':postal_code',$_POST['postal_code'],PDO::PARAM_STR);

    $stmt->execute();

    if($stmt->errorCode() !=="00000"){
        echo "There was an issue inserting the row.";
        var_dump($stmt->errorInfo());
    } else{
        echo "The row was inserted successfully";
    }


        ?>