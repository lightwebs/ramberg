<?php if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
			


        </main>

        
        <footer>
            <?php echo Generation_Theme_Footer_Builder::get_content(); ?>
		</footer>
		
        <?php /* ?>
        <footer>
		    <div class="container">
		        <div class="row">
		            <div class="col-md-4">
		                <?php dynamic_sidebar( 'footer_menu_1' ) ?>
		            </div>
		            <div class="col-md-3 offset-md-1 mt-30">
		                <?php dynamic_sidebar( 'footer_menu_2' ) ?>
		            </div>
		            <div class="col-md-2 mt-30">
	                    <?php dynamic_sidebar( 'footer_menu_3' ) ?>
		            </div>
		            <div class="col-md-2">
		                <div class="logo-block">
		                    <?php dynamic_sidebar( 'footer_menu_4' ) ?>
		                </div>
		            </div>
		        </div>
		    </div>
		</footer> */ ?>
        
		<?php wp_footer(); ?>
	</body>
</html>
