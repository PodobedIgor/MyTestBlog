<!doctype html>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require "foo.php";

?>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" >
    <title>Admin</title>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <button class="btn btn-success mt-2" data-toggle="modal" data-target="#create"><i class="fa fa-plus"></i></button>
            <table class="table table-striped table-hover mt-2 ">
              <thead class="thead-dark">
                <th>ID</th>
                <th>TITLE</th>
                <th>IMAGE</th>
                <th>TEXT</th>
                <th>CATEGORIE_ID</th>
                <th>PUBDATE</th>
                <th>VIEWS</th>
                <th>ACTION</th>
              </thead>
              <tbody>
                <?php $art=$crud->get_articles();
                foreach ($art as $article) {
                    ?>
                <tr>
                  <td><?php echo $article['id']; ?></td>
                  <td><?php echo $article['title']; ?></td>
                  <td><?php echo $article['image']; ?></td>
                  <td><?php echo $article['text']; ?></td>
                  <td><?php echo $article['categorie_id']; ?></td>
                  <td><?php echo $article['pubdate']; ?></td>
                  <td><?php echo $article['views']; ?></td>
                  <td><a href="?id=<?php echo $article['id']; ?>" class="btn btn-success" data-toggle="modal" data-target="#edit<?php echo $article['id']; ?>"><i class="fa fa-edit"></i></a>
                    <a href="" class="btn btn-danger" data-toggle="modal" data-target="#delete<?php echo $article['id']; ?>"><i class="fa fa-trash-o"></i></a>
                  </td>

                </tr>
                <!-- Modal edit -->
                <div class="modal fade" id="edit<?php echo $article['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update article</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form action="?id=<?php echo $article['id']; ?>" method="post">
                          <div class="form-group">
                            <small>Id</small>
                            <input type="text" class="form-control" name="id" value="<?php echo $article['id']; ?>"/>
                          </div>
                          <div class="form-group">
                            <small>Title</small>
                            <input type="text" class="form-control" name="title" value="<?php echo $article['title']; ?>" />
                          </div>
                          <div class="form-group">
                            <small>Image</small>
                            <input type="text" class="form-control" name="image" value="<?php echo $article['image']; ?>" />
                          </div>
                          <div class="form-group">
                            <small>Text</small>
                            <input type="text" class="form-control" name="text" value="<?php echo $article['text']; ?>"/>
                          </div>
                          <div class="form-group">
                              <small>Categorie_id</small>
                            <input type="text" class="form-control" name="categorie_id" value="<?php echo $article['categorie_id']; ?>"/>
                          </div>
                          <div class="form-group">
                            <small>Pubdate</small>
                            <input type="text" class="form-control" name="pubdate" value="<?php echo $article['pubdate']; ?>"/>
                          </div>
                          <div class="form-group">
                            <small>Views</small>
                            <input type="text" class="form-control" name="views" value="<?php echo $article['views']; ?>"/>
                          </div>
                            </div>

                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="edit">Save</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Modal edit -->

                <!-- Modal delete -->
                <div class="modal fade" id="delete<?php echo $article['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete article № <?php echo $article['id']; ?> ?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                        <div class="modal-footer">
                          <form action="?id=<?php echo $article['id']; ?>" method="post">

                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="delete">Delete</button>
                            <?var_dump($article['id']);?>
                        </form>
                        </div>
                    </div>
                  </div>
                </div>
                <!-- Modal delete -->
                <?php
                }
                ?>
              </tbody>
            </table>
        </div>
      </div>
    </div>
    <!-- Modal create -->
    <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add article</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="" method="post">
              <div class="form-group">
                <input type="text" class="form-control" name="title" value="" placeholder="Title"/>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="image" value="" placeholder="Image"/>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="text" value="" placeholder="Text"/>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="categorie_id" value="" placeholder="Categorie"/>
              </div>
                </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="add">Save</button>

            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal create -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" ></script>
  </body>
</html>
