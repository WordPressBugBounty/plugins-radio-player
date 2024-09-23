import Player from "../../../src/js/player/Player";
import {useMounted} from "../../../src/js/includes/functions";

import {useState, useEffect} from '@wordpress/element';
import {Placeholder, Spinner, PanelBody, SelectControl, ToolbarGroup, ToolbarButton} from '@wordpress/components';
import {useBlockProps, InspectorControls, BlockControls} from '@wordpress/block-editor';

export default function Edit({attributes, setAttributes}) {

    const [players, setPlayers] = useState([]);
    const [data, setData] = useState(null);
    const [isLoading, setIsLoading] = useState(false);
    const [edit, setEdit] = useState(!attributes.id);

    useEffect(() => {
        setIsLoading(true);

        wp.ajax
            .post('rp_get_players', {
                nonce: radioPlayer.nonce,
            })
            .done(({players, total}) => {

                if (attributes.id && !data) {
                    setData(players.find(player => player.id == attributes.id)['config']);
                }

                setPlayers(players);
            })
            .fail((error) => console.log(error))
            .always(() => setIsLoading(false));

    }, []);

    const isMounted = useMounted();
    useEffect(() => {
        if (!isMounted) return;

        if (!attributes.id) {
            setEdit(true);
            setData(null);
        } else {
            setEdit(false);
            setData(players.find(player => player.id == attributes.id)['config']);
        }

    }, [attributes.id])


    let options = players.map(player => ({value: player.id, label: player.title}));

    options = [
        {
            value: 0,
            label: wp.i18n.__('--- Select a player ---', 'radio-player')
        },
        ...options
    ]

    return (
        <div {...useBlockProps()}>
            <InspectorControls>

                <PanelBody title={wp.i18n.__('Player Settings', 'wp-radio')}>
                    <SelectControl
                        label={wp.i18n.__('Select Player', 'wp-radio')}
                        value={attributes.id}
                        options={options}
                        onChange={(newValue) => {
                            setAttributes({
                                id: !!newValue ? parseInt(newValue) : '',
                            });
                        }}
                    />
                </PanelBody>
            </InspectorControls>

            <BlockControls>
                <ToolbarGroup>
                    <ToolbarButton
                        icon='edit'
                        label={wp.i18n.__('Change Player', 'radio-player')}
                        text={wp.i18n.__('Change Player', 'radio-player')}
                        onClick={() => {
                            setAttributes({id: ''});
                        }}
                    />
                </ToolbarGroup>
            </BlockControls>

            {
                (edit || !attributes.id) ?
                    <Placeholder
                        icon="controls-play"
                        label={wp.i18n.__('Radio Player', 'wp-radio')}>

                        {isLoading ? <Spinner/>
                            : <SelectControl
                                label={wp.i18n.__('Select Player', 'radio-player')}
                                value={attributes.id}
                                options={options}
                                onChange={(newValue) => {
                                    setAttributes({
                                        id: !!newValue ? parseInt(newValue) : '',
                                    });
                                }}
                            />
                        }

                    </Placeholder>
                    :
                    <>
                        {
                            !data ?
                                <Placeholder icon="controls-play" label={wp.i18n.__('Radio Player', 'wp-radio')}>
                                    <Spinner/>
                                </Placeholder>
                                :
                                <div style={{paddingTop: '1px', textAlign: attributes.align}}>
                                    <Player
                                        data={{
                                            id: attributes.id,
                                            playerType: 'shortcode',
                                            ...data,
                                        }}
                                    />
                                </div>
                        }
                    </>
            }
        </div>
    )


}
