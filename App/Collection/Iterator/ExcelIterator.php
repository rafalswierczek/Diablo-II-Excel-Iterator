<?php declare(strict_types=1);

namespace App\Collection\Iterator;

use App\Service\Validation\TableValidator;

class ExcelIterator implements \Iterator
{
    public array $table;
    private ?array $row;
    private array $fileLines;
    private array $fileHeader;
    private string $fileName;
    private array $columnNames;
    private TableValidator $tableValidator;
    private array $skipColumnValues;
    private bool $invalidHeader;

    /**
     * @param array $skipColumnValues ['colName1' => ['Expansion', 'some value'], 'colName2' => ['1', '256', '1024']]
     */
    public function __construct(string $filePath, string $fileName, array $columnNames, TableValidator $tableValidator, array $skipColumnValues = [])
    {
        $this->fileLines = @file($filePath) ?: [null];
        $this->fileHeader = $this->getHeader();
        $this->fileName = $fileName;
        $this->columnNames = $columnNames;
        $this->tableValidator = $tableValidator;
        $this->skipColumnValues = $skipColumnValues;
    }

    public function rewind(): void
    {
        $this->invalidHeader = false;

        if(!$this->tableValidator->headerHasDuplicateColumnNames($this->fileHeader, $this->fileName))
        {
            if(!$this->tableValidator->headerHasAllNecessaryColumns($this->fileHeader, $this->columnNames, $this->fileName))
                $this->invalidHeader = true;
        }
        else
            $this->invalidHeader = true;

        reset($this->fileLines);

        $this->next(); // skip header and continue all useless rows until first useful row

        $this->invalidHeader = false;
    }

    public function current(): array
    {
        $this->table[] = $this->row;
        return $this->row;
    }

    public function key(): int
    {
        return (int)key($this->fileLines) + 1;
    }

    public function next(): void
    {
        do {
            next($this->fileLines);
        }
        while($this->continue());
    }

    public function valid(): bool
    {
        if(null === $this->row) // end of file or validation error
        {
            $this->tableValidator->isEmptyTable($this->table, $this->fileName);
            return false;
        }

        // sadly it's most likely necessary to check valid header each iteration because only valid method can stop the loop in normal way
        if($this->invalidHeader || [] === $this->row) // invalid header OR row has invalid column quantity
            return false;

        return true;
    }

    private function continue(): bool
    {
        $this->row = $this->getRow();

        if(null === $this->row)
            return false;
        
        foreach($this->skipColumnValues as $columnName => $columnValues)
        {
            if(in_array($this->row[$columnName] ?? null, $columnValues))
                return true;
        }

        return false;
    }

    private function getRow(): ?array
    {
        if((false === $current = current($this->fileLines)) || empty($current)) // end of file
            return null;
            
        $row = array_map('trim', explode("	", $current)); // explode returns always not empty array

        if($this->tableValidator->rowHasInvalidColumnQuantity($row, $this->fileHeader, $this->fileName, (key($this->fileLines) + 1)))
            return null;

        $row = array_combine($this->fileHeader, $row);

        return !empty($row) ? $row : null; // null in case when header and row are valid and empty
    }

    private function getHeader(): array
    {
        return array_map('trim', explode("	", $this->fileLines[0] ?? ''));
    }
}