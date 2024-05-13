const Ziggy = {"url":"http:\/\/localhost","port":null,"defaults":{},"routes":{"debugbar.openhandler":{"uri":"_debugbar\/open","methods":["GET","HEAD"]},"debugbar.clockwork":{"uri":"_debugbar\/clockwork\/{id}","methods":["GET","HEAD"],"parameters":["id"]},"debugbar.assets.css":{"uri":"_debugbar\/assets\/stylesheets","methods":["GET","HEAD"]},"debugbar.assets.js":{"uri":"_debugbar\/assets\/javascript","methods":["GET","HEAD"]},"debugbar.cache.delete":{"uri":"_debugbar\/cache\/{key}\/{tags?}","methods":["DELETE"],"parameters":["key","tags"]},"sanctum.csrf-cookie":{"uri":"sanctum\/csrf-cookie","methods":["GET","HEAD"]},"ignition.healthCheck":{"uri":"_ignition\/health-check","methods":["GET","HEAD"]},"ignition.executeSolution":{"uri":"_ignition\/execute-solution","methods":["POST"]},"ignition.updateConfig":{"uri":"_ignition\/update-config","methods":["POST"]},"dashboard":{"uri":"dashboard","methods":["GET","HEAD"]},"projects.index":{"uri":"projects","methods":["GET","HEAD"]},"projects.create":{"uri":"projects\/create","methods":["GET","HEAD"]},"projects.store":{"uri":"projects","methods":["POST"]},"projects.show":{"uri":"projects\/{project}","methods":["GET","HEAD"],"parameters":["project"]},"projects.edit":{"uri":"projects\/{project}\/edit","methods":["GET","HEAD"],"parameters":["project"],"bindings":{"project":"id"}},"projects.update":{"uri":"projects\/{project}","methods":["PUT","PATCH"],"parameters":["project"],"bindings":{"project":"id"}},"projects.destroy":{"uri":"projects\/{project}","methods":["DELETE"],"parameters":["project"],"bindings":{"project":"id"}},"tasks.index":{"uri":"tasks","methods":["GET","HEAD"]},"tasks.create":{"uri":"tasks\/create","methods":["GET","HEAD"]},"tasks.store":{"uri":"tasks","methods":["POST"]},"tasks.show":{"uri":"tasks\/{task}","methods":["GET","HEAD"],"parameters":["task"],"bindings":{"task":"id"}},"tasks.edit":{"uri":"tasks\/{task}\/edit","methods":["GET","HEAD"],"parameters":["task"],"bindings":{"task":"id"}},"tasks.update":{"uri":"tasks\/{task}","methods":["PUT","PATCH"],"parameters":["task"],"bindings":{"task":"id"}},"tasks.destroy":{"uri":"tasks\/{task}","methods":["DELETE"],"parameters":["task"],"bindings":{"task":"id"}},"users.index":{"uri":"users","methods":["GET","HEAD"]},"users.create":{"uri":"users\/create","methods":["GET","HEAD"]},"users.store":{"uri":"users","methods":["POST"]},"users.show":{"uri":"users\/{user}","methods":["GET","HEAD"],"parameters":["user"]},"users.edit":{"uri":"users\/{user}\/edit","methods":["GET","HEAD"],"parameters":["user"],"bindings":{"user":"id"}},"users.update":{"uri":"users\/{user}","methods":["PUT","PATCH"],"parameters":["user"]},"users.destroy":{"uri":"users\/{user}","methods":["DELETE"],"parameters":["user"]},"profile.edit":{"uri":"profile","methods":["GET","HEAD"]},"profile.update":{"uri":"profile","methods":["PATCH"]},"profile.destroy":{"uri":"profile","methods":["DELETE"]},"register":{"uri":"register","methods":["GET","HEAD"]},"login":{"uri":"login","methods":["GET","HEAD"]},"password.request":{"uri":"forgot-password","methods":["GET","HEAD"]},"password.email":{"uri":"forgot-password","methods":["POST"]},"password.reset":{"uri":"reset-password\/{token}","methods":["GET","HEAD"],"parameters":["token"]},"password.store":{"uri":"reset-password","methods":["POST"]},"verification.notice":{"uri":"verify-email","methods":["GET","HEAD"]},"verification.verify":{"uri":"verify-email\/{id}\/{hash}","methods":["GET","HEAD"],"parameters":["id","hash"]},"verification.send":{"uri":"email\/verification-notification","methods":["POST"]},"password.confirm":{"uri":"confirm-password","methods":["GET","HEAD"]},"password.update":{"uri":"password","methods":["PUT"]},"logout":{"uri":"logout","methods":["POST"]}}};
if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
    Object.assign(Ziggy.routes, window.Ziggy.routes);
}
export { Ziggy };