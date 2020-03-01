<?php

class Coupon extends DB
{
  public $CouponName, $CouponCode, $CouponTypeID, $CouponQuantity, $CouponPrice, $CouponPriceCondition, $CouponStartDate, $CouponEndDate, $CouponExpEndDate;
  public $CouponTypeName;
  function getAll()
  {
    return $this->selectDB("SELECT * FROM Coupon");
  }

  function getCouponDetail($id){
    return $this->selectDB("SELECT * FROM Coupon WHERE CouponID = ?", [$id])[0];
  }

  function getCouponType(){
    return $this->selectDB("SELECT * from CouponType");
  }

  function getCouponList($keyword)
  {
    if ($keyword == null)
      return $this->selectDB("SELECT Coupon.*, CouponType.CouponTypeName FROM Coupon, CouponType WHERE CouponType.CouponTypeID = Coupon.CouponTypeID");
    else
      return $this->selectDB("SELECT Coupon.*, CouponType.CouponTypeName FROM Coupon, CouponType WHERE CouponType.CouponTypeID = Coupon.CouponTypeID and Coupon.CounponName like '%?%'", $keyword);
  }

  function create($coupon)
  {
    return $this->insertDB("INSERT INTO Coupon(CouponName, CouponTypeID, CouponCode, Quantity, Price, PriceCondition, StartDate, EndDate, ExpEndDate) VALUES (?,?,?,?,?,?,?,?,?) ;",
    [$coupon->CouponName, $coupon->CouponTypeID, $coupon->CouponCode, $coupon->CouponQuantity, $coupon->CouponPrice, $coupon->CouponPriceCondition, $coupon->CouponStartDate, $coupon->EndDate, $coupon->ExpEndDate]);
  }

  function createCouponType($coupon){
    return $this->insertDB("INSERT INTO CouponType(CouponTypeName) VALUES (?) ;",[$coupon->CouponTypeName]);
  }

  function update($id)
  {
  }

  function delete($ids = [])
  {
    if (empty($ids)) {
      return "error: ids is empty";
    }
    return $this->deleteDB("DELETE FROM Coupon where CouponID IN ("  . str_repeat("?,", count($ids) - 1) . "?);",$ids);
  }
}
