<?php

class User extends DB {
  public $userId;
  public $UserName;
  public $NickName;
  public $Gender;
  public $Birthdate;
  public $Phone;
  public $Email;
  public $Password;
  public $Country;
  public $City;
  public $District;
  public $Address;
  public $PostalCode;
  public $CreateDate;


  function getAll(){  //read所有user資料
    return $this->selectDB("SELECT * FROM User ;");
  }

  function getUserById($id){
    return $this->selectDB("SELECT * FROM User WHERE UserID = ? ;",[$id])[0];
  }

  function createUser($UserAddArray){  //add新增會員
    $UserAddArray = array($UserName,$NickName,$Gender,$Birthdate,$Phone,
    $Email,$Password,$Country,$City,$District,$Address,$PostalCode,$CreateDate);
    //抓user輸入內容為array的value，定義$UserName這些變數是在view裡寫嗎? 
    return $this->insertDB("INSERT INTO User (`UserName`,`NickName`,`Gender`,`Birthdate`,`Phone`,
    `Email`,`Password`,`Country`,`City`,`District`,`Address`,`PostalCode`,`CreateDate`) 
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?) ;", $UserAddArray);

  }


  function updateUser($UserUpdateArray){  //修改會員
    $UserUpdateArray = array($UserName,$NickName,$Gender,$Birthdate,$Phone,
    $Email,$Password,$Country,$City,$District,$Address,$PostalCode,$CreateDate,$UserID);
    return $this->updateDB("UPDATE User SET `UserName=?`, `NickName=?`,`Gender=?`,`Birthdate=?`,`Phone=?`,
    `Email=?`,`Password=?`,`Country=?`,`City=?`,`District=?`,`Address=?`,`PostalCode=?`,`CreateDate=?` WHERE `UserID=?`",$UserInfoArray);

  }


  function deleteUser($userId){  //刪除會員
    return $this->deleteDB("DELETE FROM User WHERE `UserID=?`", $userId);

  }

 
}



?>
