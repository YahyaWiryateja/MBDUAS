<?php

declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use Slim\Factory\AppFactory;

return function (App $app) {

    // get
    $app->get('/maskapai', function (Request $request, Response $response) {
        $db = $this->get(PDO::class);

        $query = $db->query('CALL GetAllId_maskapai()');
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $response->getBody()->write(json_encode($results));

        return $response->withHeader("Content-Type", "application/json");
    });

    $app->get('/pelanggan', function (Request $request, Response $response) {
        $db = $this->get(PDO::class);

        $query = $db->query('CALL GetAllId_pelanggan()');
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $response->getBody()->write(json_encode($results));

        return $response->withHeader("Content-Type", "application/json");
    });

    $app->get('/penerbangan', function (Request $request, Response $response) {
        $db = $this->get(PDO::class);

        $query = $db->query('CALL GetAllId_penerbangan()');
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $response->getBody()->write(json_encode($results));

        return $response->withHeader("Content-Type", "application/json");
    });

    $app->get('/pemesanan', function (Request $request, Response $response) {
        $db = $this->get(PDO::class);

        $query = $db->query('CALL GetAllId_pemesanan()');
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $response->getBody()->write(json_encode($results));

        return $response->withHeader("Content-Type", "application/json");
    });


    //Get by id
    $app->get('/pelanggan/{id}', function (Request $request, Response $response, $args) {
        $db = $this->get(PDO::class);
    

        $pelanggan_id = $args['id'];
    
        try {
            $query = $db->prepare('CALL GetById_pelanggan(:p_pelanggan_id)');
            $query->bindParam(':p_pelanggan_id', $pelanggan_id, PDO::PARAM_INT);
            $query->execute();
    
            $results = $query->fetchAll(PDO::FETCH_ASSOC);
    
            if (empty($results)) {
           
                $response->getBody()->write(json_encode(['error' => 'Data pelanggan tidak ditemukan']));
                return $response->withStatus(404)->withHeader("Content-Type", "application/json");
            }
    
            $response->getBody()->write(json_encode($results[0]));
            return $response->withHeader("Content-Type", "application/json")->withStatus(200);
        } catch (PDOException $e) {
           
            $response->getBody()->write(json_encode(['error' => 'Database error: ' . $e->getMessage()]));
            return $response->withStatus(500)->withHeader("Content-Type", "application/json");
        } catch (Exception $e) {
            
            $response->getBody()->write(json_encode(['error' => 'Internal Server Error: ' . $e->getMessage()]));
            return $response->withStatus(500)->withHeader("Content-Type", "application/json");
        }
    });
    
    
    $app->get('/maskapai/{id}', function (Request $request, Response $response, $args) {
        $db = $this->get(PDO::class);
        $maskapai_id = $args['id'];
    
        try {
            $query = $db->prepare('CALL GetById_maskapai(:p_maskapai_id)');
            $query->bindParam(':p_maskapai_id', $maskapai_id, PDO::PARAM_INT);
            $query->execute();
    
            $results = $query->fetchAll(PDO::FETCH_ASSOC);
    
            if (empty($results)) {
           
                $response->getBody()->write(json_encode(['error' => 'Data maskapai tidak ditemukan']));
                return $response->withStatus(404)->withHeader("Content-Type", "application/json");
            }
    
            
            $response->getBody()->write(json_encode($results[0]));
            return $response->withHeader("Content-Type", "application/json")->withStatus(200);
        } catch (PDOException $e) {
            
            $response->getBody()->write(json_encode(['error' => 'Database error: ' . $e->getMessage()]));
            return $response->withStatus(500)->withHeader("Content-Type", "application/json");
        } catch (Exception $e) {
            
            $response->getBody()->write(json_encode(['error' => 'Internal Server Error: ' . $e->getMessage()]));
            return $response->withStatus(500)->withHeader("Content-Type", "application/json");
        }
    });

    $app->get('/penerbangan/{id}', function (Request $request, Response $response, $args) {
        $db = $this->get(PDO::class);
        $penerbangan_id = $args['id'];
    
        try {
            $query = $db->prepare('CALL GetById_penerbangan(:p_penerbangan_id)');
            $query->bindParam(':p_penerbangan_id', $penerbangan_id, PDO::PARAM_INT);
            $query->execute();
    
            $results = $query->fetchAll(PDO::FETCH_ASSOC);
    
            if (empty($results)) {
                $response->getBody()->write(json_encode(['error' => 'Data penerbangan tidak ditemukan']));
                return $response->withStatus(404)->withHeader("Content-Type", "application/json");
            }
    
            $response->getBody()->write(json_encode($results[0]));
            return $response->withHeader("Content-Type", "application/json")->withStatus(200);
        } catch (PDOException $e) {
            $response->getBody()->write(json_encode(['error' => 'Database error: ' . $e->getMessage()]));
            return $response->withStatus(500)->withHeader("Content-Type", "application/json");
        } catch (Exception $e) {
            $response->getBody()->write(json_encode(['error' => 'Internal Server Error: ' . $e->getMessage()]));
            return $response->withStatus(500)->withHeader("Content-Type", "application/json");
        }
    });
    
    $app->get('/pemesanan/{id}', function (Request $request, Response $response, $args) {
        $db = $this->get(PDO::class);
        $pemesanan_id = $args['id'];
    
        try {
            $query = $db->prepare('CALL GetById_pemesanan(:p_pemesanan_id)');
            $query->bindParam(':p_pemesanan_id', $pemesanan_id, PDO::PARAM_INT);
            $query->execute();
    
            $results = $query->fetchAll(PDO::FETCH_ASSOC);
    
            if (empty($results)) {
                $response->getBody()->write(json_encode(['error' => 'Data pemesanan tidak ditemukan']));
                return $response->withStatus(404)->withHeader("Content-Type", "application/json");
            }
    
            $response->getBody()->write(json_encode($results[0]));
            return $response->withHeader("Content-Type", "application/json")->withStatus(200);
        } catch (PDOException $e) {
            $response->getBody()->write(json_encode(['error' => 'Database error: ' . $e->getMessage()]));
            return $response->withStatus(500)->withHeader("Content-Type", "application/json");
        } catch (Exception $e) {
            $response->getBody()->write(json_encode(['error' => 'Internal Server Error: ' . $e->getMessage()]));
            return $response->withStatus(500)->withHeader("Content-Type", "application/json");
        }
    });
    
    
    
    
    //post database
    $app->post('/pelanggan', function (Request $request, Response $response) {
        $parsedBody = $request->getParsedBody();
    
        $nama = $parsedBody["nama"];
        $email = $parsedBody["email"];
        $telepon = $parsedBody["telepon"];
    
        $db = $this->get(PDO::class);
    
        try {
            $query = $db->prepare('CALL Insert_pelanggan(:p_nama, :p_email, :p_telepon)');
            $query->bindParam(':p_nama', $nama, PDO::PARAM_STR);
            $query->bindParam(':p_email', $email, PDO::PARAM_STR);
            $query->bindParam(':p_telepon', $telepon, PDO::PARAM_STR);
            $query->execute();
    
            $response->getBody()->write(json_encode(
                [
                    'message' => 'Data pelanggan disimpan'
                ]
            ));
    
            return $response->withHeader("Content-Type", "application/json")->withStatus(201); 
        } catch (Exception $e) {
            return $response->withJson(['error' => $e->getMessage()], 500); 
        }
    });

    $app->post('/maskapai', function (Request $request, Response $response) {
        $parsedBody = $request->getParsedBody();
        $nama = $parsedBody["nama"];
        $kode = $parsedBody["kode"];
    
        $db = $this->get(PDO::class);
    
        try {
            $query = $db->prepare('CALL Insert_maskapai(:p_nama, :p_kode)');
            $query->bindParam(':p_nama', $nama, PDO::PARAM_STR);
            $query->bindParam(':p_kode', $kode, PDO::PARAM_STR);
            $query->execute();
    
            $response->getBody()->write(json_encode(['message' => 'Data maskapai disimpan']));
            return $response->withHeader("Content-Type", "application/json")->withStatus(201); 
        } catch (Exception $e) {
            return $response->withJson(['error' => $e->getMessage()], 500);
        }
    });
    
    $app->post('/penerbangan', function (Request $request, Response $response) {
        $parsedBody = $request->getParsedBody();
        $maskapai_id = $parsedBody["maskapai_id"];
        $nomor_penerbangan = $parsedBody["nomor_penerbangan"];
        $asal = $parsedBody["asal"];
        $tujuan = $parsedBody["tujuan"];
        $waktu_keberangkatan = $parsedBody["waktu_keberangkatan"];
        $waktu_kedatangan = $parsedBody["waktu_kedatangan"];
        $harga = $parsedBody["harga"];
    
        $db = $this->get(PDO::class);
    
        try {
            $query = $db->prepare('CALL Insert_penerbangan(:p_maskapai_id, :p_nomor_penerbangan, :p_asal, :p_tujuan, :p_waktu_keberangkatan, :p_waktu_kedatangan, :p_harga)');
            $query->bindParam(':p_maskapai_id', $maskapai_id, PDO::PARAM_INT);
            $query->bindParam(':p_nomor_penerbangan', $nomor_penerbangan, PDO::PARAM_STR);
            $query->bindParam(':p_asal', $asal, PDO::PARAM_STR);
            $query->bindParam(':p_tujuan', $tujuan, PDO::PARAM_STR);
            $query->bindParam(':p_waktu_keberangkatan', $waktu_keberangkatan, PDO::PARAM_STR);
            $query->bindParam(':p_waktu_kedatangan', $waktu_kedatangan, PDO::PARAM_STR);
            $query->bindParam(':p_harga', $harga, PDO::PARAM_STR);
    
            $query->execute();
    
            $response_data = ['message' => 'Data penerbangan disimpan'];
            $response->getBody()->write(json_encode($response_data));
    
            return $response->withHeader("Content-Type", "application/json")->withStatus(201);
        } catch (PDOException $e) {
            $error_message = ['error' => 'Database error: ' . $e->getMessage()];
            $response->getBody()->write(json_encode($error_message));
            return $response->withHeader("Content-Type", "application/json")->withStatus(500);
        } catch (Exception $e) {
            $error_message = ['error' => 'Internal Server Error: ' . $e->getMessage()];
            $response->getBody()->write(json_encode($error_message));
            return $response->withHeader("Content-Type", "application/json")->withStatus(500); 
        }
    });

    $app->post('/pemesanan', function (Request $request, Response $response) {
        $parsedBody = $request->getParsedBody();
        $pelanggan_id = $parsedBody["pelanggan_id"];
        $penerbangan_id = $parsedBody["penerbangan_id"];
        $jumlah_tiket = $parsedBody["jumlah_tiket"];
    
        $db = $this->get(PDO::class);
    
        try {
            $query = $db->prepare('CALL Insert_pemesanan(:p_pelanggan_id, :p_penerbangan_id, :p_jumlah_tiket)');
            $query->bindParam(':p_pelanggan_id', $pelanggan_id, PDO::PARAM_INT);
            $query->bindParam(':p_penerbangan_id', $penerbangan_id, PDO::PARAM_INT);
            $query->bindParam(':p_jumlah_tiket', $jumlah_tiket, PDO::PARAM_INT);
            $query->execute();
    
            // Periksa apakah pemesanan berhasil ditambahkan
            if ($query->rowCount() === 0) {
                // Gagal menambahkan pemesanan, kirim respons 500 Internal Server Error
                $response->getBody()->write(json_encode(['error' => 'Gagal menambahkan pemesanan']));
                return $response->withStatus(500)->withHeader("Content-Type", "application/json");
            }
    
            // Pemesanan berhasil ditambahkan, kirim respons berhasil
            $response->getBody()->write(json_encode(['message' => 'Pemesanan berhasil ditambahkan']));
            return $response->withHeader("Content-Type", "application/json")->withStatus(201);
        } catch (PDOException $e) {
            // Tangani kesalahan PDO dan kirim respons 500 Internal Server Error
            $response->getBody()->write(json_encode(['error' => 'Database error: ' . $e->getMessage()]));
            return $response->withStatus(500)->withHeader("Content-Type", "application/json");
        } catch (Exception $e) {
            // Tangani kesalahan umum dan kirim respons 500 Internal Server Error
            $response->getBody()->write(json_encode(['error' => 'Internal Server Error: ' . $e->getMessage()]));
            return $response->withStatus(500)->withHeader("Content-Type", "application/json");
        }
    });
    

    
    // Put database
    $app->put('/pelanggan/{id}', function (Request $request, Response $response, $args) {
        $currentId = $args['id'];
        $parsedBody = $request->getParsedBody();
        $nama = $parsedBody["nama"];
        $email = $parsedBody["email"];
        $telepon = $parsedBody["telepon"];
        
        $db = $this->get(PDO::class);
        
        try {
            $query = $db->prepare('CALL Update_pelanggan(:p_id, :p_nama, :p_email, :p_telepon)');
            $query->bindParam(':p_id', $currentId, PDO::PARAM_INT);
            $query->bindParam(':p_nama', $nama, PDO::PARAM_STR);
            $query->bindParam(':p_email', $email, PDO::PARAM_STR);
            $query->bindParam(':p_telepon', $telepon, PDO::PARAM_STR);
            $query->execute();
    
            // Periksa apakah ID ditemukan dalam database sebelum memberikan respons
            if ($query->rowCount() === 0) {
                // ID tidak ditemukan, kirim respons 404 Not Found
                $response->getBody()->write(json_encode(['error' => 'Data pelanggan dengan ID ' . $currentId . ' tidak ditemukan']));
                return $response->withStatus(404)->withHeader("Content-Type", "application/json");
            }
    
            // ID ditemukan dan data diperbarui, kirim respons berhasil
            $response->getBody()->write(json_encode(['message' => 'Data pelanggan dengan ID ' . $currentId . ' telah diperbarui']));
            return $response->withHeader("Content-Type", "application/json")->withStatus(200);
        } catch (Exception $e) {
            // Tangani kesalahan umum dan kirim respons 500 Internal Server Error
            $response->getBody()->write(json_encode(['error' => 'Internal Server Error: ' . $e->getMessage()]));
            return $response->withStatus(500)->withHeader("Content-Type", "application/json");
        }
    });
    

    $app->put('/maskapai/{id}', function (Request $request, Response $response, $args) {
        $currentId = $args['id'];
        $parsedBody = $request->getParsedBody();
        $nama = $parsedBody["nama"];
        $kode = $parsedBody["kode"];
        
        $db = $this->get(PDO::class);
        
        try {
            $query = $db->prepare('CALL Update_maskapai(:p_id, :p_nama, :p_kode)');
            $query->bindParam(':p_id', $currentId, PDO::PARAM_INT);
            $query->bindParam(':p_nama', $nama, PDO::PARAM_STR);
            $query->bindParam(':p_kode', $kode, PDO::PARAM_STR);
            $query->execute();
    
            // Periksa apakah ID ditemukan dalam database sebelum memberikan respons
            if ($query->rowCount() === 0) {
                // ID tidak ditemukan, kirim respons 404 Not Found
                $response->getBody()->write(json_encode(['error' => 'Data maskapai dengan ID ' . $currentId . ' tidak ditemukan']));
                return $response->withStatus(404)->withHeader("Content-Type", "application/json");
            }
    
            // ID ditemukan dan data diperbarui, kirim respons berhasil
            $response->getBody()->write(json_encode(['message' => 'Data maskapai dengan ID ' . $currentId . ' telah diperbarui']));
            return $response->withHeader("Content-Type", "application/json")->withStatus(200);
        } catch (Exception $e) {
            // Tangani kesalahan umum dan kirim respons 500 Internal Server Error
            $response->getBody()->write(json_encode(['error' => 'Terjadi kesalahan saat memperbarui data maskapai']));
            return $response->withStatus(500)->withHeader("Content-Type", "application/json");
        }
    });
    

    $app->put('/penerbangan/{id}', function (Request $request, Response $response, $args) {
        $currentId = $args['id'];
        $parsedBody = $request->getParsedBody();
        
        // Dapatkan data dari request body
        $maskapai_id = $parsedBody["maskapai_id"];
        $nomor_penerbangan = $parsedBody["nomor_penerbangan"];
        $asal = $parsedBody["asal"];
        $tujuan = $parsedBody["tujuan"];
        $waktu_keberangkatan = $parsedBody["waktu_keberangkatan"];
        $waktu_kedatangan = $parsedBody["waktu_kedatangan"];
        $harga = $parsedBody["harga"];
        
        $db = $this->get(PDO::class);
        
        try {
            $query = $db->prepare('CALL Update_penerbangan(:p_id, :p_maskapai_id, :p_nomor_penerbangan, :p_asal, :p_tujuan, :p_waktu_keberangkatan, :p_waktu_kedatangan, :p_harga)');
            $query->bindParam(':p_id', $currentId, PDO::PARAM_INT);
            $query->bindParam(':p_maskapai_id', $maskapai_id, PDO::PARAM_INT);
            $query->bindParam(':p_nomor_penerbangan', $nomor_penerbangan, PDO::PARAM_STR);
            $query->bindParam(':p_asal', $asal, PDO::PARAM_STR);
            $query->bindParam(':p_tujuan', $tujuan, PDO::PARAM_STR);
            $query->bindParam(':p_waktu_keberangkatan', $waktu_keberangkatan, PDO::PARAM_STR);
            $query->bindParam(':p_waktu_kedatangan', $waktu_kedatangan, PDO::PARAM_STR);
            $query->bindParam(':p_harga', $harga, PDO::PARAM_STR);
            $query->execute();
            
            
            if ($query->rowCount() === 0) {
               
                $response->getBody()->write(json_encode(['error' => 'Data penerbangan dengan ID ' . $currentId . ' tidak ditemukan']));
                return $response->withStatus(404)->withHeader("Content-Type", "application/json");
            }
    
            
            $response->getBody()->write(json_encode(['message' => 'Data penerbangan dengan ID ' . $currentId . ' telah diperbarui']));
            return $response->withHeader("Content-Type", "application/json")->withStatus(200);
        } catch (PDOException $e) {
           
            $response->getBody()->write(json_encode(['error' => 'Database error: ' . $e->getMessage()]));
            return $response->withStatus(500)->withHeader("Content-Type", "application/json");
        } catch (Exception $e) {
            
            $response->getBody()->write(json_encode(['error' => 'Internal Server Error: ' . $e->getMessage()]));
            return $response->withStatus(500)->withHeader("Content-Type", "application/json");
        }
    });
    
    $app->put('/pemesanan/{id}', function (Request $request, Response $response, $args) {
        $currentId = $args['id'];
        $parsedBody = $request->getParsedBody();
        $pelanggan_id = $parsedBody["pelanggan_id"];
        $penerbangan_id = $parsedBody["penerbangan_id"];
        $jumlah_tiket = $parsedBody["jumlah_tiket"];
    
        $db = $this->get(PDO::class);
    
        try {
            $query = $db->prepare('CALL Update_pemesanan(:p_pemesanan_id, :p_pelanggan_id, :p_penerbangan_id, :p_jumlah_tiket)');
            $query->bindParam(':p_pemesanan_id', $currentId, PDO::PARAM_INT);
            $query->bindParam(':p_pelanggan_id', $pelanggan_id, PDO::PARAM_INT);
            $query->bindParam(':p_penerbangan_id', $penerbangan_id, PDO::PARAM_INT);
            $query->bindParam(':p_jumlah_tiket', $jumlah_tiket, PDO::PARAM_INT);
            $query->execute();
    
            // Periksa apakah pemesanan berhasil diperbarui
            if ($query->rowCount() === 0) {
                // Gagal memperbarui pemesanan, kirim respons 404 Not Found
                $response->getBody()->write(json_encode(['error' => 'Data pemesanan dengan ID ' . $currentId . ' tidak ditemukan']));
                return $response->withStatus(404)->withHeader("Content-Type", "application/json");
            }
    
            // Pemesanan berhasil diperbarui, kirim respons berhasil
            $response->getBody()->write(json_encode(['message' => 'Data pemesanan dengan ID ' . $currentId . ' telah diperbarui']));
            return $response->withHeader("Content-Type", "application/json")->withStatus(200);
        } catch (PDOException $e) {
            // Tangani kesalahan PDO dan kirim respons 500 Internal Server Error
            $response->getBody()->write(json_encode(['error' => 'Database error: ' . $e->getMessage()]));
            return $response->withStatus(500)->withHeader("Content-Type", "application/json");
        } catch (Exception $e) {
            // Tangani kesalahan umum dan kirim respons 500 Internal Server Error
            $response->getBody()->write(json_encode(['error' => 'Internal Server Error: ' . $e->getMessage()]));
            return $response->withStatus(500)->withHeader("Content-Type", "application/json");
        }
    });
    
    

    //delete database
    $app->delete('/pelanggan/{id}', function (Request $request, Response $response, $args) {
        $currentId = $args['id'];
        $db = $this->get(PDO::class);
    
        try {
            $query = $db->prepare('CALL Delete_pelanggan(:p_id)');
            $query->bindParam(':p_id', $currentId, PDO::PARAM_INT);
            $query->execute();
    
            if ($query->rowCount() === 0) {
                $response = $response->withStatus(404);
                $response->getBody()->write(json_encode(
                    [
                        'message' => 'Data tidak ditemukan'
                    ]
                ));
            } else {
                $response->getBody()->write(json_encode(
                    [
                        'message' => 'Data pelanggan dengan ID ' . $currentId . ' telah dihapus dari database'
                    ]
                ));
            }
        } catch (PDOException $e) {
            $response = $response->withStatus(500);
            $response->getBody()->write(json_encode(
                [
                    'message' => 'Database error ' . $e->getMessage()
                ]
            ));
        }
    
        return $response->withHeader("Content-Type", "application/json");
    });    


    $app->delete('/maskapai/{id}', function (Request $request, Response $response, $args) {
        $currentId = $args['id'];
        $db = $this->get(PDO::class);
    
        try {
            $query = $db->prepare('CALL Delete_maskapai(:p_id)');
            $query->bindParam(':p_id', $currentId, PDO::PARAM_INT);
            $query->execute();
    
            if ($query->rowCount() === 0) {
                $response = $response->withStatus(404);
                $response->getBody()->write(json_encode(
                    [
                        'message' => 'Data tidak ditemukan'
                    ]
                ));
            } else {
                $response->getBody()->write(json_encode(
                    [
                        'message' => 'Data maskapai dengan ID ' . $currentId . ' telah dihapus dari database'
                    ]
                ));
            }
        } catch (PDOException $e) {
            $response = $response->withStatus(500);
            $response->getBody()->write(json_encode(
                [
                    'message' => 'Database error ' . $e->getMessage()
                ]
            ));
        }
    
        return $response->withHeader("Content-Type", "application/json");
    });

    $app->delete('/penerbangan/{id}', function (Request $request, Response $response, $args) {
        $currentId = $args['id'];
        $db = $this->get(PDO::class);
        
        try {
            $query = $db->prepare('CALL Delete_penerbangan(:p_id)');
            $query->bindParam(':p_id', $currentId, PDO::PARAM_INT);
            $query->execute();
    
            if ($query->rowCount() === 0) {
                
                $response = $response->withStatus(404);
                $response->getBody()->write(json_encode(['message' => 'Data tidak ditemukan']));
            } else {
             
                $response->getBody()->write(json_encode(['message' => 'Data penerbangan dengan ID ' . $currentId . ' telah dihapus dari database']));
            }
        } catch (PDOException $e) {
           
            $response = $response->withStatus(500);
            $response->getBody()->write(json_encode(['message' => 'Database error: ' . $e->getMessage()]));
        }
    
        return $response->withHeader("Content-Type", "application/json");
    });
    
    $app->delete('/pemesanan/{id}', function (Request $request, Response $response, $args) {
        $currentId = $args['id'];
        $db = $this->get(PDO::class);
    
        try {
            $query = $db->prepare('CALL Delete_pemesanan(:p_pemesanan_id)');
            $query->bindParam(':p_pemesanan_id', $currentId, PDO::PARAM_INT);
            $query->execute();
    
            if ($query->rowCount() === 0) {
                // Data tidak ditemukan, kirim respons 404 Not Found
                $response = $response->withStatus(404);
                $response->getBody()->write(json_encode(['message' => 'Data tidak ditemukan']));
            } else {
                // Data berhasil dihapus, kirim respons berhasil
                $response->getBody()->write(json_encode(['message' => 'Data pemesanan dengan ID ' . $currentId . ' telah dihapus dari database']));
            }
        } catch (PDOException $e) {
            // Tangani kesalahan PDO dan kirim respons 500 Internal Server Error
            $response = $response->withStatus(500);
            $response->getBody()->write(json_encode(['message' => 'Database error: ' . $e->getMessage()]));
        }
    
        return $response->withHeader("Content-Type", "application/json");
    });
    
    

};
