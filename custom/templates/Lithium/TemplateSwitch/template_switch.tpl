<div class="card card-widget">
	<div class="card-header">
		{$TEMPLATES_HEAD}
	</div>
	<div class="card-body">
		<form action="" method="post">

			<select name="new_template" class="form-control mb-3">
				{foreach  from=$TEMPLATES_DATA item=template}
					<option value="{$template['id']}" {if ($TEMPLATES_ACTIVE == $template['id'])} selected {/if}>{$template['name']}
					</option>
				{/foreach}
			</select>
			<input style="width: 100%;" type="submit" class="btn form-control" value="{$SUBMIT}">
		</form>
	</div>
</div>