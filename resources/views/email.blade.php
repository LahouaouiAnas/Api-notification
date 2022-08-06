<h2 class="text-success"> Rappel</h2>
<h4>Bonjour</h4>

<style>
    .email{
        box-shadow: 0px 0px 1px;
    }
    h2{
        color: rgb(201, 0, 0);
    }
    .strong{
        color: rgb(15, 0, 131);
        font-weight: 800;
    }

</style>

<div class="email">
    <p>
        le dossier avec reference <span class="strong">{{$reminder_line->dossier->ref}}</span>  
         arrive a la phase de <span class="strong">{{$reminder_line->remindertype->description}}</span>  le
          <span class="strong">{{substr($date_event,0, 10) }}</span>
    </p>
</div>



