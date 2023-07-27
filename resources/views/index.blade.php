@props(['id_create' => 'create_modal',
         'id_show' => 'show_modal',
         'id_edit' => 'edit_modal',
         'status_activate' => 'enable',
         'status_deactivate' => 'disabled',
         ])
<x-layouts.primary>
 
  <x-header/>

        <x-modal :id="$id_create">
            <x-form :status="$status_activate"></x-create>
        </x-modal>

        <x-modal :id="$id_show">
            <x-form :status="$status_deactivate"></x-create>
        </x-modal>

        <x-modal :id="$id_edit">
          <x-form :status="$status_activate"></x-create>
        </x-modal>

    <table id="table" class="table">

        <thead>
            <tr>
              <th scope="col" class="col-1" style="display: none;"></th>
              <th scope="col" class="col-3">NOM DU CONTACT</th>
              <th scope="col" class="col-3">SOCIÉTÉ</th>
              <th scope="col" class="col-1">STATUT</th>
              <th scope="col" class="col-1"></th>
            </tr>
        </thead>

        <tbody>

          @foreach( $contacts as $contact)

            <tr>
              <td class="id" style="display: none;">{{ $contact->id}}</td>
              <td style="color: #5c5c5c;">{{ $contact->nom }} {{ $contact->prenom }}</td>

              <td>{{ $contact->organisationNom }}</td>

              <td> <span class="badge .rounded-pill {{ $contact->statut == 'LEAD' ? 'text-bg-blue1' : ($contact->statut == 'CLIENT' ? 'text-bg-green1': 'text-bg-red1'); }}">
                  {{ $contact->statut }}
                  </span>
              </td>
              <td>
                <i class="fa-regular fa-eye mx-1 show" data-bs-toggle="modal" data-bs-target="#show_modal" style="color: #6e6e6e;"></i>
                <i class="fa-solid fa-pencil mx-1 edit"  data-bs-toggle="modal" data-bs-target="#edit_modal" style="color: #6e6e6e;"></i>
                <i class="fa-solid fa-trash-can mx-1 delete" style="color: #ff656a;"></i>
              </td>
            </tr>
            
          @endforeach

        </tbody>

    </table>

   
  <x-footer :contacts="$contacts"/>
      

 </x-layouts.primary>