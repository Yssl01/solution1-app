    <h4>Détail du contact</h4>
    
    <form class="p-2"><!--form-->
       
            <div class="row mb-3">

                <div class="form-group col">
                    <label for="prenom" class="form-label">Prénom</label>
                    <input type="text" class="form-control" name="prenom" id="prenom" {{ $status }}>
                </div>

                <div class="form-group col">                         
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" name="nom" id="nom" {{ $status }}>
                </div>

            </div>
    
            <div class="form-group mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="text" class="form-control" name="email" id="email" {{ $status }}>
            </div>
    
            <div class="form-group mb-3">
                <label for="entreprise" class="form-label">Entreprise</label>
                <input type="text" class="form-control" name="entreprise" id="entreprise" {{ $status }}>
            </div>

            <div class="form-group mb-3">
                    <label for="adresse" class="form-label">Adresse</label>
                    <div class="form-floating">                   
                        <textarea class="form-control"  id="adresse" style="height: 100px" id="adresse" {{ $status }}></textarea>         
                    </div>
            </div>
    
            <div class="row mb-3">
                <div class="form-group col-4">
                    <label for="code_postal" class="form-label">Code Postal</label>
                    <input type="text" class="form-control" name="codepostal" id="code_postal" {{ $status }}>
                </div>
                <div class="form-group col-8">
                    <label for="ville" class="form-label">Vile</label>
                    <input type="text" class="form-control" name="ville" id="ville" {{ $status }}>
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="statut" class="form-label">Statut</label>
                <select class="form-select mb-3" name="statut" id="statut" {{ $status }}>
                    <option value="CLIENT">CLIENT</option>
                    <option value="PROSPECT">PROSPECT</option>
                    <option value="LEAD">LEAD</option>
                </select>
            </div>
            <p class="errorsform d-block bg-danger text-white text-center"></p>
            <label id="confirmation"></label>

    </form><!--End form-->
