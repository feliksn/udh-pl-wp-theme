<!-- .position-relative - это класс Bootstrap, который позволяет использовать абсолютное позиционирование внутри элемента. В данном случае он нужен для того, чтобы .stretched-link мог занимать всю площадь .post-item и делать его кликабельным. Простыми словами блокируюет .streched-link в этом месте. Если не будет этого класса ссылка будет выходить за пределы записи на целую страницу. -->
<div class="post-item position-relative">

    <!-- .post-image -->
    <div class="overflow-hidden">
        <!-- при .stretched-link ссылка для картинки не нужна -->
        <?php the_post_thumbnail('medium', array('class' => 'post-image')); ?>
    </div>

    <div class="post-body">
        <!-- .heading - это класс для стилизации всех заголовков, который будет использоваться не только для записей. Определен в elements/heading/heading.css -->
        <h3 class="heading mb-0"><?php the_title(); ?></h3>
        <p class="mb-0"><?php the_excerpt(); ?></p>
        <!-- .stretched-link - нужен для того, чтобы весь блок был кликабельным, а не только картинка и заголовок. Это такой трюк bootstrap с помощью которого можно сделать кликабельным весь блок с помощью одной ссылки -->
        <!-- .link - это класс для стилизации всех ссылок, который будет использоваться не только для записи. Определен в elements/link/link.css -->
        <a class="link stretched-link mt-0" href="<?php the_permalink(); ?>">
            zobacz wszystkie produkty
        </a>
    </div><!--.post-body-->

</div><!--.post-item-->