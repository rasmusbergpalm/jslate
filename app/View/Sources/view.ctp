<div class="sources view">
<h2><?php  echo __('Source'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($source['Source']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($source['Source']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Source'), array('action' => 'edit', $source['Source']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Source'), array('action' => 'delete', $source['Source']['id']), null, __('Are you sure you want to delete # %s?', $source['Source']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Sources'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Source'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sourceproperties'), array('controller' => 'sourceproperties', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sourceproperty'), array('controller' => 'sourceproperties', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Sourceproperties'); ?></h3>
	<?php if (!empty($source['Sourceproperty'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Source Id'); ?></th>
		<th><?php echo __('Key'); ?></th>
		<th><?php echo __('Value'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($source['Sourceproperty'] as $sourceproperty): ?>
		<tr>
			<td><?php echo $sourceproperty['id']; ?></td>
			<td><?php echo $sourceproperty['source_id']; ?></td>
			<td><?php echo $sourceproperty['key']; ?></td>
			<td><?php echo $sourceproperty['value']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'sourceproperties', 'action' => 'view', $sourceproperty['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'sourceproperties', 'action' => 'edit', $sourceproperty['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'sourceproperties', 'action' => 'delete', $sourceproperty['id']), null, __('Are you sure you want to delete # %s?', $sourceproperty['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Sourceproperty'), array('controller' => 'sourceproperties', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
