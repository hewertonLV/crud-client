<div class="row">
<div class="col-lg-4 col-md-6 col-12">
    <x-input-label for="name" :value="__('Name')"/>
    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                  value="{{$client->name ?? ''}}" required autofocus autocomplete="name"/>
</div>
<div class="col-lg-3 col-md-6 col-12">
    <x-input-label for="cpf" :value="__('CPF')"/>
    <x-text-input id="cpf" class="block mt-1 w-full" type="text" name="cpf" value="{{$client->cpf ?? ''}}"
                  required autofocus autocomplete="name"/>
</div>
<div class="col-lg-3 col-md-10 col-10">
    <x-input-label for="email" :value="__('Email')"/>
    <x-text-input id="email" class="block mt-1 w-full" type="text" name="email"
                  value="{{$client->email ?? ''}}" required autofocus autocomplete="name"/>
</div>
<div class="col-2" style="display: flex; align-self: end">
    <button class="btn btn-primary text-black" type="submit">Salvar</button>
</div>
</div>
