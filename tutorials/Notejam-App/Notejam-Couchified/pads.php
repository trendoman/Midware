<?php require_once( 'couch/cms.php' ); ?>
    <cms:template title='Pads' clonable='1'  routable='1'>
        <cms:editable 
            type='relation' 
            has='one' 
            masterpage='users/index.php' 
            name='pad_owner' 
            label='Owner' 
            no_guix='1' 
            required='1'
        />
        
        <!-- define routes -->
        <cms:route 
            name='page_view' 
            path='{:id}' 
            filters='authenticated | pad_exists | owns_pad'
            >
            
            <cms:route_validators
                id='non_zero_integer'
            />
        </cms:route>
        
        <cms:route name='create_view' path='create' filters='authenticated' />
        
        <cms:route 
            name='edit_view' 
            path='{:id}/edit' 
            filters='authenticated | pad_exists | owns_pad'
            >
            
            <cms:route_validators
                id='non_zero_integer'
            />
        </cms:route>
        
        <cms:route 
            name='delete_view' 
            path='{:id}/delete' 
            filters='authenticated | pad_exists | owns_pad'
            >
            
            <cms:route_validators
                id='non_zero_integer'
            />
        </cms:route>
            
    </cms:template>

    
    <!-- find the matched route (view). Respond with 404 if no route matches. -->
    <cms:match_route debug='0' is_404='1' />
    
    
    <!-- and invoke snippet corresponding to the selected view -->
    <cms:embed "views/pads/<cms:show k_matched_route />.html" />

    
<?php COUCH::invoke( K_IGNORE_CONTEXT ); ?> 