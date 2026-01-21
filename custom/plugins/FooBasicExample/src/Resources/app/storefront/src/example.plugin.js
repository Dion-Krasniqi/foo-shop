const { PluginBaseClass } = window;

import { log } from 'missionlog';

log.init({initializer: 'INFO'}, (level, tag, msg, params) => {
    console.log(`${level}: [${tag}]`, msg, ...params);
});

export default class ExamplePlugin extends PluginBaseClass{
    init() {
        console.log('init');
        log.info('initializer',
            'example plugin started',
        this);
    }
}