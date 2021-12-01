<?php

use Petrik\Vizsgaremek\Admin;
use Petrik\Vizsgaremek\VirtualisOrokbefogadas;
use Petrik\Vizsgaremek\Macska;
use Petrik\Vizsgaremek\Felhasznalok;
use Petrik\Vizsgaremek\Rendezvenyek;
use Petrik\Vizsgaremek\Orokbefogadas;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

return function(Slim\App $app){
    $app->get('/admin', function(Request $request, Response $response, $args){
        $admin = Admin::all();
        $kimenet=$admin->toJson();

        $response->getBody()->write($kimenet);
        return $response->withHeader('Content-type', 'application/json'); 
        });

    $app->post('/admin', function(Request $request, Response $response, $args){
            $input = json_decode($request->getBody(),true);
            //Bemenet validáció
            $admin=Admin::create($input);
            $admin->save();
            $kimenet= $admin->toJson();
            $response->getBody()->write($kimenet);
            return $response
                ->withStatus(201)
                ->withHeader('Content-type', 'application/json');
        });

    $app->delete('/admin/{id}',function(Request $request, Response $response, $args){
            if (!is_numeric($args['id']) || $args['id'] <= 0) {
               $ki=json_encode(['error'=>'Az ID potizv egész számnak kell lennie!']);
               $response->getBody()->write($ki);
               return $response
                    ->withHeader('Content-type', 'application/json')
                    ->withStatus(400);
            }
            $admin=Admin::find($args['id']);
            if ($admin===null) {
                $ki=json_encode(['error'=>'Nincs ilyen ID-jű admin!']);
                $response->getBody()->write($ki);
               return $response
                    ->withHeader('Content-type', 'application/json')
                    ->withStatus(404);
            }
            $admin->delete();
            return $response
                ->withHeader('Content-type', 'application/json')
                ->withStatus(204);
            });

    $app->put('/admin/{id}', function(Request $request, Response $response, $args){
            if (!is_numeric($args['id']) || $args['id'] <= 0) {
                $ki=json_encode(['error'=>'Az ID potizv egész számnak kell lennie!']);
                $response->getBody()->write($ki);
                return $response
                    ->withHeader('Content-type', 'application/json')
                    ->withStatus(400);
            }
            $admin=Admin::find($args['id']);
            if ($admin===null) {
                $ki=json_encode(['error'=>'Nincs ilyen ID-jű admin!']);
                $response->getBody()->write($ki);
            return $response
                    ->withHeader('Content-type', 'application/json')
                    ->withStatus(404);
            }
            $input = json_decode($request->getBody(),true);
            $admin->fill($input);
            $admin->save();
            $response->getBody()->write($admin->toJson());
            return $response
                ->withHeader('Content-type', 'application/json')
                ->withStatus(200);
             });

    $app->get('/admin/{id}', function(Request $request, Response $response, $args){
            if (!is_numeric($args['id']) || $args['id'] <= 0) {
                $ki =json_encode(['error' => "Az id pozitv egész számnak kell legyen!"]);
                $response->getBody()->write($ki);
                return $response
                ->withHeader('Content-type','application/json')
                ->withStatus(400);
            }
            $admin = Admin::find($args['id']);
            if ($admin === null) {
                $ki = json_encode(['error' => 'Nincs ilyen ID-jű admin']);
                $response->getBody()->write($ki);
                return $response
                ->withHeader('Content-type','application/json')
                ->withStatus(404);
            }
            $response->getBody()->write($admin->toJson());
            return $response
                ->withHeader('Content-type','application/json')
                ->withStatus(200);
            });

    //------------------------------------Virtualis orokbefogadas tábla---------------------------------------
    $app->get('/virtualis_orokbefogadas',function(Request $request,Response $response){
        $virtualis_orokbefogadas=VirtualisOrokbefogadas::all();
        $kimenet= $virtualis_orokbefogadas->toJson();
        
        $response->getBody()->write($kimenet);
        return $response
            ->withHeader('Content-type','application/json');

        });

    $app->post('/virtualis_orokbefogadas',function(Request $request,Response $response){
        $input=json_decode($request-> getBody(),true);
        $virtualis=VirtualisOrokbefogadas::create($input);
        
        $virtualis->save();

        $kimenet=$virtualis->toJson();

        $response->getBody()->write($kimenet);
        return $response
            ->withStatus(201)
            ->withHeader('Content-type','application/json');

        });

    $app->delete('/virtualis_orokbefogadas/{id}', function(Request $request,Response $response, array $args){
        if (!is_numeric($args['id']) || $args['id'] <= 0) {
            $ki = json_encode(['error ' => 'Az ID pozitív egész szám kell legyen!']);
            $response->getBody()->write($ki);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(400);
        }
        $virtualis = VirtualisOrokbefogadas::find($args['id']);
        if ($virtualis === null) {
            $ki = json_encode(['error' => 'Nincs ilyen ID-val örökbefogadás']);
            $response->getBody()->write($ki);
            return $response
                ->withHeader('Content-type','application/json')
                ->withStatus(404);
        }
        $virtualis->delete();
        return $response
            ->withStatus(204);
        });

    $app->put('/virtualis_orokbefogadas/{id}', function(Request $request,Response $response, array $args){
        if (!is_numeric($args['id']) || $args['id'] <= 0) {
            $ki = json_encode(['error ' => 'Az ID pozitív egész szám kell legyen!']);
            $response->getBody()->write($ki);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(400);
        }
        $virtualis = VirtualisOrokbefogadas::find($args['id']);
        if ($virtualis === null) {
            $ki = json_encode(['error' => 'Nincs ilyen ID-val örökbefogadás']);
            $response->getBody()->write($ki);
            return $response
                ->withHeader('Content-type','application/json')
                ->withStatus(404);
        }
        $input=json_decode($request->getBody(),true);
        $virtualis->fill($input);
        $virtualis->save();
        $response->getBody()->write($virtualis->toJson());
        return $response
            ->withHeader('Content-type','application/json')
            ->withStatus(200);
        });

    $app->get('/virtualis_orokbefogadas/{id}', function(Request $request,Response $response, array $args){
        if (!is_numeric($args['id']) || $args['id'] <= 0) {
            $ki = json_encode(['error ' => 'Az ID pozitív egész szám kell legyen!']);
            $response->getBody()->write($ki);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(400);
        }
        $virtualis = VirtualisOrokbefogadas::find($args['id']);
        if ($virtualis === null) {
            $ki = json_encode(['error' => 'Nincs ilyen ID-val örökbefogadás']);
            $response->getBody()->write($ki);
            return $response
                ->withHeader('Content-type','application/json')
                ->withStatus(404);
        }
        $kimenet= $virtualis->toJson();
        
        $response->getBody()->write($kimenet);
        return $response
            ->withHeader('Content-type','application/json')
            ->withStatus(200);
        });

    //------------------------------------Macska tábla---------------------------------------
    $app->get('/macska', function(Request $request, Response $response, array $args){
        $macska =Macska::all();
        $kimenet=$macska->toJson();
        
        $response->getBody()->write($kimenet);

        return $response->withHeader('Content-type','application/json');
        });

    $app->post('/macska', function(Request $request, Response $response){
        $input= json_decode($request->getBody(), true);

        $macska =Macska::create($input);
        $macska->save();
        
        $kimenet=$macska->toJson();

        $response->getBody()->write($kimenet);
        return $response
            ->withStatus(201)
            ->withHeader('Content-type','application/json');
        });

    $app->delete('/macska/{id}',function(Request $request, Response $response, array $args){
    
        if (!is_numeric($args['id']) || $args['id'] <= 0) {
            $ki =json_encode(['error' => "Az id pozitv egész számnak kell legyen!"]);
            $response->getBody()->write($ki);
            return $response
            ->withHeader('Content-type','application/json')
            ->withStatus(400);
        }
        $macska = Macska::find($args['id']);
        if ($macska === null) {
            $ki = json_encode(['error' => 'Nincs ilyen ID-jű macska']);
            $response->getBody()->write($ki);
            return $response
            ->withHeader('Content-type','application/json')
            ->withStatus(404);
        }
        $macska->delete();
        return $response
        
            ->withStatus(204);
        });

    $app->put('/macska/{id}', function(Request $request, Response $response, array $args){

        if (!is_numeric($args['id']) || $args['id'] <= 0) {
            $ki =json_encode(['error' => "Az id pozitv egész számnak kell legyen!"]);
            $response->getBody()->write($ki);
            return $response
            ->withHeader('Content-type','application/json')
            ->withStatus(400);
        }
        $macska = Macska::find($args['id']);
        if ($macska === null) {
            $ki = json_encode(['error' => 'Nincs ilyen ID-jű macska']);
            $response->getBody()->write($ki);
            return $response
            ->withHeader('Content-type','application/json')
            ->withStatus(404);
        }
        $input = json_decode($request->getBody(), true);
        $macska->fill($input);
        $macska->save();
        $response->getBody()->write($macska->toJson());
        return $response
        ->withHeader('Content-type','application/json')
        ->withStatus(200);

        });

    $app->get('/macska/{id}', function(Request $request, Response $response, array $args){
        
        if (!is_numeric($args['id']) || $args['id'] <= 0) {
            $ki =json_encode(['error' => "Az id pozitv egész számnak kell legyen!"]);
            $response->getBody()->write($ki);
            return $response
            ->withHeader('Content-type','application/json')
            ->withStatus(400);
        }
        $macska = Macska::find($args['id']);
        if ($macska === null) {
            $ki = json_encode(['error' => 'Nincs ilyen ID-jű macska']);
            $response->getBody()->write($ki);
            return $response
            ->withHeader('Content-type','application/json')
            ->withStatus(404);
        }
        $response->getBody()->write($macska->toJson());
        return $response
        ->withHeader('Content-type','application/json')
        ->withStatus(200);
            });

            
    //------------------------------------Felhasználók tábla---------------------------------------
    $app->get('/felhasznalok', function(Request $request, Response $response, $args){
            $felhasznalok = Felhasznalok::all();
            $kimenet=$felhasznalok->toJson();
    
            $response->getBody()->write($kimenet);
            return $response->withHeader('Content-type', 'application/json'); 
            });
    
    $app->post('/felhasznalok', function(Request $request, Response $response, $args){
                $input = json_decode($request->getBody(),true);
                //Bemenet validáció
                $felhasznalok=Felhasznalok::create($input);
                $felhasznalok->save();
                $kimenet= $felhasznalok->toJson();
                $response->getBody()->write($kimenet);
                return $response
                    ->withStatus(201)
                    ->withHeader('Content-type', 'application/json');
            });
    
    $app->delete('/felhasznalok/{id}',function(Request $request, Response $response, $args){
                if (!is_numeric($args['id']) || $args['id'] <= 0) {
                    $ki=json_encode(['error'=>'Az ID potizv egész számnak kell lennie!']);
                    $response->getBody()->write($ki);
                    return $response
                        ->withHeader('Content-type', 'application/json')
                        ->withStatus(400);
                }
                $felhasznalok=Felhasznalok::find($args['id']);
                if ($felhasznalok===null) {
                    $ki=json_encode(['error'=>'Nincs ilyen ID-jű admin!']);
                    $response->getBody()->write($ki);
                    return $response
                        ->withHeader('Content-type', 'application/json')
                        ->withStatus(404);
                }
                $felhasznalok->delete();
                return $response
                    ->withHeader('Content-type', 'application/json')
                    ->withStatus(204);
                });
    
    $app->put('/felhasznalok/{id}', function(Request $request, Response $response, $args){
                if (!is_numeric($args['id']) || $args['id'] <= 0) {
                    $ki=json_encode(['error'=>'Az ID potizv egész számnak kell lennie!']);
                    $response->getBody()->write($ki);
                    return $response
                        ->withHeader('Content-type', 'application/json')
                        ->withStatus(400);
                }
                $felhasznalok=Felhasznalok::find($args['id']);
                if ($felhasznalok===null) {
                    $ki=json_encode(['error'=>'Nincs ilyen ID-jű felhasznalok!']);
                    $response->getBody()->write($ki);
                return $response
                        ->withHeader('Content-type', 'application/json')
                        ->withStatus(404);
                }
                $input = json_decode($request->getBody(),true);
                $felhasznalok->fill($input);
                $felhasznalok->save();
                $response->getBody()->write($felhasznalok->toJson());
                return $response
                    ->withHeader('Content-type', 'application/json')
                    ->withStatus(200);
                    });
    
    $app->get('/felhasznalok/{id}', function(Request $request, Response $response, $args){
                        if (!is_numeric($args['id']) || $args['id'] <= 0) {
                            $ki =json_encode(['error' => "Az id pozitv egész számnak kell legyen!"]);
                            $response->getBody()->write($ki);
                            return $response
                            ->withHeader('Content-type','application/json')
                            ->withStatus(400);
                        }
                        $felhasznalok = Felhasznalok::find($args['id']);
                        if ($felhasznalok === null) {
                            $ki = json_encode(['error' => 'Nincs ilyen ID-jű felhasznalo']);
                            $response->getBody()->write($ki);
                            return $response
                            ->withHeader('Content-type','application/json')
                            ->withStatus(404);
                        }
                        $response->getBody()->write($felhasznalok->toJson());
                        return $response
                            ->withHeader('Content-type','application/json')
                            ->withStatus(200);
                        });
    
    //------------------------------------Rendezvények tábla---------------------------------------
    $app->get('/rendezmenyek', function(Request $request, Response $response, $args){
        $rendezmenyek = Rendezvenyek::all();
        $kimenet=$rendezmenyek->toJson();

        $response->getBody()->write($kimenet);
        return $response->withHeader('Content-type', 'application/json'); 
        });

    $app->post('/rendezmenyek', function(Request $request, Response $response, $args){
            $input = json_decode($request->getBody(),true);
            //Bemenet validáció
            $rendezmenyek=Rendezvenyek::create($input);
            $rendezmenyek->save();
            $kimenet= $rendezmenyek->toJson();
            $response->getBody()->write($kimenet);
            return $response
                ->withStatus(201)
                ->withHeader('Content-type', 'application/json');
        });

    $app->delete('/rendezmenyek/{id}',function(Request $request, Response $response, $args){
            if (!is_numeric($args['id']) || $args['id'] <= 0) {
               $ki=json_encode(['error'=>'Az ID potizv egész számnak kell lennie!']);
               $response->getBody()->write($ki);
               return $response
                    ->withHeader('Content-type', 'application/json')
                    ->withStatus(400);
            }
            $rendezmenyek=Rendezvenyek::find($args['id']);
            if ($rendezmenyek===null) {
                $ki=json_encode(['error'=>'Nincs ilyen ID-jű admin!']);
                $response->getBody()->write($ki);
               return $response
                    ->withHeader('Content-type', 'application/json')
                    ->withStatus(404);
            }
            $rendezmenyek->delete();
            return $response
                ->withHeader('Content-type', 'application/json')
                ->withStatus(204);
            });

    $app->put('/rendezmenyek/{id}', function(Request $request, Response $response, $args){
            if (!is_numeric($args['id']) || $args['id'] <= 0) {
                $ki=json_encode(['error'=>'Az ID potizv egész számnak kell lennie!']);
                $response->getBody()->write($ki);
                return $response
                    ->withHeader('Content-type', 'application/json')
                    ->withStatus(400);
            }
            $rendezmenyek=Rendezvenyek::find($args['id']);
            if ($rendezmenyek===null) {
                $ki=json_encode(['error'=>'Nincs ilyen ID-jű rendezveny!']);
                $response->getBody()->write($ki);
            return $response
                    ->withHeader('Content-type', 'application/json')
                    ->withStatus(404);
            }
            $input = json_decode($request->getBody(),true);
            $rendezmenyek->fill($input);
            $rendezmenyek->save();
            $response->getBody()->write($rendezmenyek->toJson());
            return $response
                ->withHeader('Content-type', 'application/json')
                ->withStatus(200);
             });

    $app->get('/rendezmenyek/{id}', function(Request $request, Response $response, $args){
                if (!is_numeric($args['id']) || $args['id'] <= 0) {
                    $ki =json_encode(['error' => "Az id pozitv egész számnak kell legyen!"]);
                    $response->getBody()->write($ki);
                    return $response
                    ->withHeader('Content-type','application/json')
                    ->withStatus(400);
                }
                $rendezmenyek = Rendezvenyek::find($args['id']);
                if ($rendezmenyek === null) {
                    $ki = json_encode(['error' => 'Nincs ilyen ID-jű rendezveny']);
                    $response->getBody()->write($ki);
                    return $response
                    ->withHeader('Content-type','application/json')
                    ->withStatus(404);
                }
                $response->getBody()->write($rendezmenyek->toJson());
                return $response
                    ->withHeader('Content-type','application/json')
                    ->withStatus(200);
                });
    //------------------------------------Örökbefogadás tábla---------------------------------------
    $app->get('/orokbefogadas', function(Request $request, Response $response){
        $orokbefogadas = Orokbefogadas::all();
        $kimenet =$orokbefogadas->toJson();
        $response->getBody()->write($kimenet);
        return $response->withHeader('Content-type','application/json');
        
        });
    
    $app->post('/orokbefogadas', function(Request $request, Response $response){
        $input = json_decode($request->getBody(), true);
        // Bemenet validáció
        $orokbefogadas = Orokbefogadas::create($input);
        $orokbefogadas->save();
        
        $kimenet = $orokbefogadas->toJson();
        $response->getBody()->write($kimenet);
        return $response
        ->withStatus(201)
        ->withHeader('Content-type','application/json');
        });
    
    $app->delete('/orokbefogadas/{id}',function(Request $request, Response $response, array $args){
        
        if (!is_numeric($args['id']) || $args['id'] <= 0) {
            $ki =json_encode(['error' => "Az id pozitv egész számnak kell legyen!"]);
            $response->getBody()->write($ki);
            return $response
            ->withHeader('Content-type','application/json')
            ->withStatus(400);
        }
        $orokbefogadas = Orokbefogadas::find($args['id']);
        if ($orokbefogadas === null) {
            $ki = json_encode(['error' => 'Nincs ilyen ID-jű örökbefogadas']);
            $response->getBody()->write($ki);
            return $response
            ->withHeader('Content-type','application/json')
            ->withStatus(404);
        }
        $orokbefogadas->delete();
        return $response
            ->withHeader('Content-type','application/json')
            ->withStatus(204);
        });

    $app->put('/orokbefogadas/{id}', function(Request $request, Response $response, array $args){
        if (!is_numeric($args['id']) || $args['id'] <= 0) {
            $ki =json_encode(['error' => "Az id pozitv egész számnak kell legyen!"]);
            $response->getBody()->write($ki);
            return $response
            ->withHeader('Content-type','application/json')
            ->withStatus(400);
        }
        $orokbefogadas = Orokbefogadas::find($args['id']);
        if ($orokbefogadas === null) {
            $ki = json_encode(['error' => 'Nincs ilyen ID-jű örökbefogadas']);
            $response->getBody()->write($ki);
            return $response
            ->withHeader('Content-type','application/json')
            ->withStatus(404);
        }
        $input = json_decode($request->getBody(),true);
        $orokbefogadas->fill($input);
        $orokbefogadas->save();
        $response->getBody()->write($orokbefogadas->toJson());
        return $response
        ->withHeader('Content-type','application/json')
        ->withStatus(200);
        });
    
    $app->get("/orokbefogadas/{id}", function(Request $request, Response $response, array $args){
        if (!is_numeric($args['id']) || $args['id'] <= 0) {
            $ki =json_encode(['error' => "Az id pozitv egész számnak kell legyen!"]);
            $response->getBody()->write($ki);
            return $response
            ->withHeader('Content-type','application/json')
            ->withStatus(400);
        }
        $orokbefogadas = Orokbefogadas::find($args['id']);
        if ($orokbefogadas === null) {
            $ki = json_encode(['error' => 'Nincs ilyen ID-jű örökbefogadas']);
            $response->getBody()->write($ki);
            return $response
            ->withHeader('Content-type','application/json')
            ->withStatus(404);
        }
        $response->getBody()->write($orokbefogadas->toJson());
        return $response
        ->withHeader('Content-type','application/json')
        ->withStatus(200);
        });
};
