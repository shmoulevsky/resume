<div class="py-12">
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
    <h1>Форма</h1>
        @foreach($formsField as $field)
        @switch($field->type)
            @case(1)
                <div>
                    <label for="">{{$field->name}}</label>
                    <input type="text" value="">
                </div>
                @break
            @case(2)
                <div>
                    <label for="">{{$field->name}}</label>
                    <textarea name="" id="" ></textarea>
                </div>
                @break
             @case(3)
                <div>
                    @foreach($field->variants as $variant)
                        <span><?=$variant->name?></span>
                    @endforeach
                </div>
                @break    
            @default

                
        @endswitch
            
        @endforeach
        <button>Отправить</button>
    </div>

</div>

</div>