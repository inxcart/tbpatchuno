<div class="panel">
	<h3><i class="icon icon-puzzle-piece"></i> {l s='thirty bees patch - uno' mod='tbpatchuno'}</h3>
	<p>
		<strong>{l s='Security patch' mod='tbpatchuno'}</strong><br />
		{l s='This patch prevents remote code execution when allowing visitors to enter the back office in DEMO mode' mod='tbpatchuno'}<br />
	</p>

	<strong>{l s='Quick start' mod='tbpatchuno'}</strong><br />
	{l s='The following files will be patched:' mod='tbpatchuno'}
	<ol>
		<li>
			<code>/classes/controller/AdminController.php</code> {if $patchStatuses['classes/controller/AdminController.php']}<i class="icon icon-check" style="color:green"></i>{else}<i class="icon icon-times" style="color:red"></i>{/if}
		</li>
		<li>
			<code>/controllers/admin/AdminThemesController.php</code> {if $patchStatuses['controllers/admin/AdminThemesController.php']}<i class="icon icon-check" style="color:green"></i>{else}<i class="icon icon-times" style="color:red"></i>{/if}
		</li>
	</ol>
	{if $notPossible}
		<div class="alert alert-danger">
			{l s='It is not possible to patch one or more files. Check if the permission on the file are correct.' mod='tbpatchuno'}
		</div>
	{/if}
	<a href="{$postUrl|escape:'htmlall':'UTF-8'}&patchFiles=1" class="btn btn-default"{if $everythingPatched} disabled="disabled"{/if}><i class="icon icon-refresh"></i> {l s='Patch the files' mod='tbpatchuno'}</a>
</div>

