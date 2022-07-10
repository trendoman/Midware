<?php require_once( 'couch/cms.php' ); ?>
    <cms:template title='Notes' clonable='1'  routable='1'>
        <cms:editable
            name='content'
            type='textarea'
            label='Content'
        />    
        
        <cms:editable 
            name='note_owner' 
            type='relation' 
            has='one' 
            masterpage='users/index.php' 
            label='Owner' 
            required='1'
            no_guix='1' 
        />
        
        <cms:editable 
            name='note_pad' 
            type='relation' 
            has='one' 
            masterpage='pads.php' 
            label='Pad' 
            required='1'
            no_guix='1' 
        />
        
        <!-- define routes -->
        <cms:route name='list_view' path='' filters='authenticated'/>
        
        <cms:route 
            name='page_view' 
            path='{:id}'
            filters='authenticated | note_exists | owns_note'
            >
            
            <cms:route_validators
                id='non_zero_integer'
            />
        </cms:route>
        
        <cms:route name='create_view' path='create' filters='authenticated' />
        
        <cms:route 
            name='create_with_pad_view' 
            path='{:id}/create' 
            filters='authenticated | pad_exists | owns_pad'
            >
            
            <cms:route_validators
                id='non_zero_integer'
            />
        </cms:route>
        
        <cms:route 
            name='edit_view' 
            path='{:id}/edit' 
            filters='authenticated | note_exists | owns_note'
            >
            
            <cms:route_validators
                id='non_zero_integer'
            />
        </cms:route>
        
        <cms:route 
            name='delete_view' 
            path='{:id}/delete'
            filters='authenticated | note_exists | owns_note'
            >
            
            <cms:route_validators
                id='non_zero_integer'
            />
        </cms:route>
        
    </cms:template>

    
    <!-- find the matched route (view). Respond with 404 if no route matches. -->
    <cms:match_route debug='0' is_404='1' />
    
    
    <!-- and invoke snippet corresponding to the selected view -->
    <cms:embed "views/notes/<cms:show k_matched_route />.html" />
   
    

<?php COUCH::invoke( K_IGNORE_CONTEXT ); ?>  