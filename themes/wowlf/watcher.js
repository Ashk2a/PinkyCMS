const { execSync } = require('child_process');

let tasks = process.argv.slice(2);
process.env.TASKS = tasks.toString();

execSync('yarn mix watch', {stdio: 'inherit'});
