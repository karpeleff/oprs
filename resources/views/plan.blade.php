@extends('layouts.app')

@section('content')

        <div class="container-lg">
      
       <form  action="/mons_plan" method="post">
        @csrf
     
  <div class="input-group m-3">

  <label class="input-group-text" for="inputGroupSelect01">Составить план на :</label>
  <select class="form-select   "   name="mons" >

    <option value="00">январь   </option>
    <option value="01">февраль  </option>
    <option value="02">март     </option>
    <option value="03">апрель   </option>
    <option value="04">май      </option>
    <option value="05">июнь     </option>
    <option value="06">июль     </option>
    <option value="07">август   </option>
    <option value="08">сентябрь </option>
    <option value="09">октябрь  </option>
    <option value="10">ноябрь   </option>
    <option value="11">декабрь  </option> 
  </select>
  </div>

<button type="submit" class="btn btn-ghost-success">ввод</button>

       </form>
        </div>
    
@endsection
