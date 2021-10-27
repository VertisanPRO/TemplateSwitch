<div class="ui fluid card">
	<div class="content">
		<h4 class="ui header">{$TEMPLATES_HEAD}</h4>
		<div class="description">
			<form action="" method="post">
				<div class="ui form">
					<div class="grouped fields">
						<div class="field">
							<select name="new_template" class="ui selection dropdown">
								{foreach from=$TEMPLATES_DATA item=template}
									<option value="{$template['id']}" {if ($TEMPLATES_ACTIVE == $template['id'])} selected {/if}>
										{$template['name']}
									</option>
								{/foreach}
							</select>
						</div>
						<input style="width: 100%;" type="submit" class="mini ui green button" value="{$SUBMIT}">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>