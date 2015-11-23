{{content()}}
{{ link_to(listUrl, '<i class="glyphicon glyphicon-chevron-left"></i> К списку', 'class': 'btn btn-back btn-default') }}
{{ form('', 'role': 'form') }}
	{{ form.render('categoryID', ['value': categoryID]) }}
    <fieldset>
        <div class="form-group">
            {{ form.label('created') }}
            {{ form.render('created', ['class': 'form-control']) }}
        </div>    
        <div class="form-group">
            {{ form.label('sum') }}
            {{ form.render('sum', ['class': 'form-control', 'step': 'any']) }}
        </div>  
        <div class="form-group">
        	<label>Теги</label>
        	<div class="form-group__tags"></div>
			<div class="btn-group btn-group__tags btn-group-justified">
				<div class="btn-group btn-group__large">
					<input type="text" class="form-control" autocomplete="off" data-action="findTag" value="" />
				</div>
				<div class="btn-group btn-group__small">
					<a href="javascript:void(0);" data-action="addTag" class="btn btn-success glyphicon glyphicon-plus"></a>
				</div>		
			</div>
			<div class="form-group__result"></div>
			<div class="form-group__list"></div>
		</div>                   
        <div class="form-group">
            {{ submit_button('Отправить', 'class': 'btn btn-primary btn-large') }}
        </div>
    </fieldset>
</form>
<script>
	$(document).ready(function() { 
		var hashtag = new HashtagsList(); 
		hashtag.init();
	});
</script>