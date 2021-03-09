<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/kk', function () {
    return 'Hello!';
});

Route::get('/ok', function () {
    return redirect('/kk');
});

Route::get('/post/{id}', function($id) {
return "id is: " . $id;
});

Route::get('/post/{id}/{fname}/{lname}', function($id, $fname, $lname) {
return $id . " " . $fname . " " . $lname;
}) -> where(['id'=>'[0-9]+', 'fname'=>'[a-zA-Z]+', 'lname'=>'[a-zA-Z]+']);

Route::get('/sname/{name}', 'App\Http\Controllers\StudentController@rname');

//lab 4

Route::get('/twonames/{fname}/{lname}', function($fname, $lname) { 
return $fname . " " . $lname;
}) -> where(['fname'=>'[a-zA-Z]+', 'lname'=>'[a-zA-Z]+']);

// lab 5
Route::get('/lab5/{name}', 'App\Http\Controllers\StudentController@lab5');
Route::get('/sdob/{dob}', 'App\Http\Controllers\StudentController@rdob');
Route::get('/sage/{age}', 'App\Http\Controllers\StudentController@rage');

Route::get('/insert', function(){
	DB::insert('insert into student(ID, Name, Date_of_birth, GPA, Advisor)
				values(?, ?, ?, ?, ?)', ['1913', 'Yerzhan Sandubayev',
										'2001-07-18', '3.5', 'Yerbol']);
});

// lab6

Route::get('/select', function(){
	$results=DB::select('select * from student where id=?', [190113013]);
	foreach($results as $posts) {
		echo "ID is ". $posts->ID;
		echo "<br>";
		echo "Name is ". $posts->Name;
		echo "<br>";
		echo "Date of birth is ". $posts->Date_of_birth;
		echo "<br>";
		echo "GPA is ". $posts->GPA;
		echo "<br>";
		echo "Advisor is ". $posts->Advisor;
	}
});

Route::get('/update', function(){
	$up=DB::update('update student set GPA = "2.9" where id=?', [190113013]);
	return $up;
});

Route::get('/delete', function(){
	$del=DB::delete('delete from student where id=?', [1913]);
	return $del;
});

use App\Models\Student;
Route::get('/read', function(){
	$sts=Student::all();
	foreach($sts as $st) {
		echo "ID is ". $st->ID;
		echo "<br>";
		echo "Name is ". $st->Name;
		echo "<br>";
		echo "Date of birth is ". $st->Date_of_birth;
		echo "<br>";
		echo "GPA is ". $st->GPA;
		echo "<br>";
		echo "Advisor is ". $st->Advisor;
	}
});

Route::get('/insert1', function(){
	$sts = new Student;
	$sts -> ID = '19030303';
	$sts -> Name = 'John Stones';
	$sts -> Date_of_birth = '2001-09-09';
	$sts -> GPA = '2.5';
	$sts -> Advisor = 'Aisha';
	$sts -> save();
});

Route::get('/update1', function(){
	$sts = Student::find(19030303);
	$sts -> ID = '19030303';
	$sts -> Name = 'John';
	$sts -> Date_of_birth = '2001-09-09';
	$sts -> GPA = '2.1';
	$sts -> Advisor = 'Aisha';
	$sts -> save();
});

Route::get('/delete1', function(){
	Student::destroy(19030303);
});


