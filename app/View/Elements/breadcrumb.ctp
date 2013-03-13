
<ul class="breadcrumb">
      <?php if(isset($breadcrumbLinks)){ ?>
      <?php foreach ($breadcrumbLinks as $link): ?>
            <li class="<?php echo ( empty($link['link']) ? 'active' : '' ); ?>">
                  <?php if (!empty($link['link'])): ?>
                        <?php
                        echo $this->Html->link(
                                $link['label'], $link['link']
                        );
                        ?>
                        <span class="divider"><?php echo isset($link['separator'])? $link['separator']:'/'; ?></span>
                  <?php else: ?>
                        <?php echo $link['label'] ?>
            <?php endif; ?>
            </li>
<?php endforeach; ?>
      <?php } ?>
</ul>