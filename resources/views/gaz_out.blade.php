@extends('layouts.app')

@section('content')

        <div class="container-lg">
      
       <form  action="/gaz_del" method="post">
        @csrf
       <div class="input-group m-3">
  <label class="input-group-text" for="inputGroupSelect01">Техника</label>
  <select class="form-select   " id=""  name="type" >

    <option value="1">Косилка</option>
    <option value="2">Снегоуборщик</option>
  
  </select>
  </div>
  <div class="input-group m-3">

  <label class="input-group-text" for="inputGroupSelect01">Месяц</label>
  <select class="form-select   "   name="mons" >

    <option value="0">январь   </option>
    <option value="1">февраль  </option>
    <option value="2">март     </option>
    <option value="3">апрель   </option>
    <option value="4">май      </option>
    <option value="5">июнь     </option>
    <option value="6">июль     </option>
    <option value="7">август   </option>
    <option value="8">сентябрь </option>
    <option value="9">октябрь </option>
    <option value="10">ноябрь  </option>
    <option value="11">декабрь </option> 
  </select>
  </div>

  <div class="input-group m-3">
  <span class="input-group-text" id="basic-addon1">Часы работы: ч</span>
  <input type="text" class="form-control" name="count" >
</div>
<button type="submit" class="btn btn-ghost-success">Success</button>

       </form>
        </div>
    
@endsection
