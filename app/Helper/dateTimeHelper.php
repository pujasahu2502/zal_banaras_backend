<?php

use Carbon\Carbon;

function dateFormat($date){
  $date = Carbon::parse($date)->format('dm');
  return $date;
}

function stringToDate($date){
  return Carbon::parse($date);
}

function dateFormatWithMonthName($date){
  if ($date) {
    return Carbon::parse($date)->format('d M Y');
  }
  return $date;
}

function bootstrapDatepicker($date){
  return Carbon::parse($date)->format('m/d/Y');
}

function monthYear($date){
  return Carbon::parse($date)->format('m/Y');
}

function currentYear(){
  $now = Carbon::now();
  return $now->year;
}

function timeDifference($time){
  $now = Carbon::now();
  $finishTime = Carbon::now();
  return $totalDuration = $finishTime->diffInSeconds($time);

}

function todayDate(){
  return Carbon::now();
}

function todayDateOnly(){
  $dt = Carbon::now();
  return $dt->toDateString();
}

function todayDateTime(){
  $myTime = Carbon::now();
  return $myTime->toDateTimeString();
}

function addDays($date, $days){
  Carbon::parse($date)
    ->addDays($days)
    ->format('Y-m-d');
}

function getTime($date){
  $myTime = Carbon::parse($date);
  return $myTime->toTimeString();
  return $myTime->diffForHumans();
}

function getMonth($date){
  return Carbon::parse($date)->format('M');
}

function getSubMonth($date){
  return Carbon::parse($date)
    ->subMonth()
    ->format('M');
}

function gettDate($date){
  return Carbon::parse($date)->format('d');
}

function getYear($date){
  return Carbon::parse($date)->format('Y');
}

function dbDateFormat($date){
  return Carbon::parse($date)->format('Y-m-d');
}

function dbCustomDateFormat($date){
  return Carbon::parse($date)->format('Y-m-d');
}

function differenceInDays($date){
  return $date->diffInDays(todayDate());
}

function week(){
  return $week = \Carbon\Carbon::today()->subDays(1);
}

function dayOfWeek($date){
  $weekMap = [
    0 => 'SUNDAY',
    1 => 'MONDAY',
    2 => 'TUESDAY',
    3 => 'WEDNESDAY',
    4 => 'THURSDAY',
    5 => 'FRIDAY',
    6 => 'SATURDAY',
  ];
  $dayOfTheWeek = Carbon::parse($date)->dayOfWeek;
  return $weekday = $weekMap[$dayOfTheWeek];
}

function monthCode(){
  return Carbon::now()->month;
}

function dayMonthYear($date){
  $monthlyLeave = [
    1 => 'JANUARY',
    2 => 'FEBRUARY',
    3 => 'MARCH',
    4 => 'APRIL',
    5 => 'MAY',
    6 => 'JUNE',
    7 => 'JULY',
    8 => 'AUGUST',
    9 => 'SEPTEMBER',
    10 => 'OCTOBER',
    11 => 'NOVEMBER',
    12 => 'DECEMBER',
  ];
  $dayOfTheMonth = (int) Carbon::parse($date)->format('m');
  return $weekday = $monthlyLeave[$dayOfTheMonth];
}

function timeWebinar($time){
  return Carbon::parse($time)->format('h:i A');
}

function getLatestYears(){
  return range(Carbon::now()->year, (Carbon::now()->year + 8));
}

function getMonths() {
  return [
    "01" => "January",
    "02" => "February",
    "03" => "March",
    "04" => "April",
    "05" => "May",
    "06" => "June",
    "07" => "July",
    "08" => "August",
    "09" => "September",
    "10" => "October",
    "11" => "November",
    "12" => "December",
  ];
}