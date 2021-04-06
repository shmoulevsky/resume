<span>Написать комментарий:</span>
<div class="comment-form">
    <form> 
        <div>   
            <textarea data-name="comment" id="comment" class="comment-form-field border-gray-300 w-2/4 p-3"></textarea>
        </div>
        
        <button id="comment-save-btn" class="inline-block my-2 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mb-6" type="button" name="action">Отправить</button>

        <input class="comment-form-field"  type="hidden" data-name="entity-id" value="{{$resume->id}}"/>
        <input class="comment-form-field"  type="hidden" data-name="entity-type" value="resume"/>
    </form>         
</div>
@forelse($resume->comments as $comment)
    <div class="comment-item mb-8 flex w-2/4">
        <div class="comment-item-user mr-5">
            <img src="/img/man.svg" alt="">
            <span class="">{{$comment->user->name}} {{$comment->user->last_name}}</span>
        </div>
        <div class="comment-item-info">
            <span class="block text-gray-500">{!!$comment->formatDateTime!!}</span>
            <div class="border border-gray-300 p-5">
                <p>{{$comment->comment}}</p>
            </div>
            <span data-url="{{route('comments.delete', $comment->id)}}" class="delete-comment-btn delete-icon small"></span>
        </div>
    </div> 
@empty
<p>Комментариев пока нет</p>
@endforelse