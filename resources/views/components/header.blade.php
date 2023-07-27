@props(['title' => 'Liste des contacts'])

<h3 class="mt-4 mb-2">{{ $title }}</h3>


<div class="d-flex justify-content-between pt-3 pb-3">

    <form action="{{ Route('home') }}">
        
        <div class="input-group" style="width:400px;">
            
            <input id="search" type="text" name="search" class="form-control"  placeholder="Recherche..." value="{{  old('search',request()->input('search')) }}">
            
        </div>
 
    </form>
  
    <button class="btn btn-cyan"  style="color:#fff;" data-bs-toggle="modal" data-bs-target="#create_modal"><i class="fa-light fa-plus me-2"></i>Ajouter</button>
</div>
