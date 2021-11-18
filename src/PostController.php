<?php

namespace Exploit;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PostController
{
    private PostRepository $postRepository;

    public function __construct(PostRepository $postRepository) {
        $this->postRepository = $postRepository;
    }

    public function index(Request $request): Response
    {
        $content = implode(
            '</li><li>',
            array_map(
                fn (array $record) => $record['title'],
                $this->postRepository->showLines(
                    $request->query->get('start', 1),
                    $request->query->get('count', 5)
                )
            )
        );

        return new Response(<<<EOT
<html>
<body>
<h1 style="color: red">Just Poe</h1>
<h2 style="color: blue">The Raven</h2>
<form>
<input type="text" name="start" value="{$request->query->get('start')}"/>
<input type="text" name="count" value="{$request->query->get('count')}" />
<input type="submit" />
</form>
<ul><li>
$content
</li></ul>
</body>
</html>
EOT);
    }


}
