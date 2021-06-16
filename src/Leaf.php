<?php

namespace BinaryTree;

class Leaf
{
    protected $content;

    protected ?Leaf $left  = null;
    protected ?Leaf $right = null;

    public function __construct ($content)
    {
        if (!is_scalar ($content))
            throw new Exception ('Content value must be scalar');

        $this->content = $content;
    }

    public function value ()
    {
        return $this->content;
    }

    public function left (): ?self
    {
        return $this->left;
    }

    public function right (): ?self
    {
        return $this->right;
    }

    public function append (Leaf $leaf): self
    {
        if ($leaf->value () < $this->content)
        {
            if ($this->left === null)
                $this->left = $leaf;
            
            else $this->left->append ($leaf);
        }
        
        elseif ($leaf->value () > $this->content)
        {
            if ($this->right === null)
                $this->right = $leaf;
            
            else $this->right->append ($leaf);
        }

        return $this;
    }

    public function count (): int 
    {
        $count = 1;

        if ($this->left !== null)
            $count += $this->left->count ();

        if ($this->right !== null)
            $count += $this->right->count ();

        return $count;
    }

    public function leaves (): array 
    {
        $leaves = [$this];

        if ($this->left !== null)
            $leaves = array_merge ($leaves, $this->left->leaves ());
        
        if ($this->right !== null)
            $leaves = array_merge ($leaves, $this->right->leaves ());

        return $leaves;
    }

    public function values (): array 
    {
        $values = [$this->value ()];

        if ($this->left !== null)
            $values = array_merge ($values, $this->left->values ());
        
        if ($this->right !== null)
            $values = array_merge ($values, $this->right->values ());

        return $values;
    }

    public function exist ($content): bool
    {
        if (!is_scalar ($content))
            throw new Exception ('Content value must be scalar');

        if ($content == $this->content)
            return true;
        
        elseif ($content > $this->content)
            return $this->right !== null ?
                $this->right->exist ($content) : false;
        
        else return $this->left !== null ?
            $this->left->exist ($content) : false;
    }

    public function foreach (callable $callback): array
    {
        $results = [$callback ($this)];

        if ($this->left !== null)
            $results = array_merge ($results, $this->left->foreach ($callback));

        if ($this->right !== null) 
            $results = array_merge ($results, $this->right->foreach ($callback));

        return $results;
    }

    public function where (callable $callback): array 
    {
        $results = [];

        if ($callback ($this))
            $results[] = $this->content;

        if ($this->left !== null)
            $results = array_merge ($results, $this->left->where ($callback));

        if ($this->right !== null) 
            $results = array_merge ($results, $this->right->where ($callback));

        return $results;
    }
}
