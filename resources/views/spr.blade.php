@extends('layouts.app')

@section('content')

        <div class="container-lg">
      
       <form  action="/sprav_mons" method="post">
        @csrf
     
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

<button type="submit" class="btn btn-ghost-success">Success</button>

       </form>
        </div>
    
@endsection
