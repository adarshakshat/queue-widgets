<?php


$cardbg1 = esc_url( plugin_dir_url( __FILE__ ) . '/assets/img/cardbg1.png' );
$cardbg2 = esc_url( plugin_dir_url( __FILE__ ) . '/assets/img/cardbg2.png' );
$cardbg3 = esc_url( plugin_dir_url( __FILE__ ) . '/assets/img/cardbg3.png' );

?>


<style>
/**/
/*    .cardbg1::after{*/
/*        content: "";*/
/*        position: absolute;*/
/*        top: 0;*/
/*        left: 0;*/
/*        right: 0;*/
/*        bottom: 0;*/
/*        background: url('*/<?php //echo $cardbg1; ?>/*') no-repeat center center; /* Add your image URL here */*/
/*        background-size: cover; /* Ensures the image covers the entire container */*/
/*        z-index: -1; /* Ensures the background stays behind the content */*/
/*        opacity: 0.5; /* Optional: adjust the opacity to create a blend effect */*/
/*        pointer-events: none; /* Prevent interaction with the pseudo-element */*/
/**/
/*    }*/
/**/
/*    .cardbg2::after{*/
/*        content: "";*/
/*        position: absolute;*/
/*        top: 0;*/
/*        left: 0;*/
/*        right: 0;*/
/*        bottom: 0;*/
/*        background: url('*/<?php //echo $cardbg2; ?>/*') no-repeat center center; /* Add your image URL here */*/
/*        background-size: cover; /* Ensures the image covers the entire container */*/
/*        z-index: -1; /* Ensures the background stays behind the content */*/
/*        opacity: 0.5; /* Optional: adjust the opacity to create a blend effect */*/
/*        pointer-events: none; /* Prevent interaction with the pseudo-element */*/
/**/
/*    }*/
/**/
/*    .cardbg3::after{*/
/*        content: "";*/
/*        position: absolute;*/
/*        top: 0;*/
/*        left: 0;*/
/*        right: 0;*/
/*        bottom: 0;*/
/*        background: url('*/<?php //echo $cardbg3; ?>/*') no-repeat center center; /* Add your image URL here */*/
/*        background-size: cover; /* Ensures the image covers the entire container */*/
/*        z-index: -1; /* Ensures the background stays behind the content */*/
/*        opacity: 0.5; /* Optional: adjust the opacity to create a blend effect */*/
/*        pointer-events: none; /* Prevent interaction with the pseudo-element */*/
/**/
/*    }*/

.podcast-list:nth-child(1){

}
.cardbg1{
    background: url('<?php echo $cardbg1; ?>') no-repeat center center; /* Add your image URL here */
    background-size:cover;
    background-position: bottom;
}
.cardbg2{
    background: url('<?php echo $cardbg2; ?>') no-repeat center center; /* Add your image URL here */
    background-size:contain;
    background-position-y: bottom;
    background-position-x: unset;
    background-repeat:repeat-y;
}
.cardbg3{
    background-size:contain;

    background: url('<?php echo $cardbg3; ?>') no-repeat center center; /* Add your image URL here */
    background-position-y: bottom;
    background-position-x: unset;
    background-repeat:repeat-y;
}


</style>


