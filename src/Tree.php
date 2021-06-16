<?php

namespace BinaryTree;

class Tree
{
    protected Leaf $root;
    
    public function __construct ($root)
    {
        $this->root = new Leaf ($root);
    }

    public function append (Leaf $leaf): self 
    {
        $this->root->append ($leaf);

        return $this;
    }

    public function count (): int 
    {
        return $this->root->count ();
    }

    public function leaves (): array
    {
        return $this->root->leaves ();
    }

    public function values (): array
    {
        return $this->root->values ();
    }

    public function exist ($content): bool
    {
        return $this->root->exist ($content);
    }

    public function foreach (callable $callback): array
    {
        return $this->root->foreach ($callback);
    }

    public function where (callable $callback): array
    {
        return $this->root->where ($callback);
    }
}
